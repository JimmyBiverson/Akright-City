<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class ContentController extends Controller
{
    public function index(string $resource): View
    {
        $config = $this->resource($resource);
        $modelClass = $config['model'];
        $items = $modelClass::orderBy($config['order'])->paginate(25);

        return view('admin.content.index', compact('config', 'items', 'resource'));
    }

    public function create(string $resource): View
    {
        $config = $this->resource($resource);

        return view('admin.content.form', [
            'config' => $config,
            'resource' => $resource,
            'item' => null,
            'values' => [],
        ]);
    }

    public function store(Request $request, string $resource): RedirectResponse
    {
        $config = $this->resource($resource);
        $modelClass = $config['model'];
        $data = $this->validatedData($request, $config, null);
        $item = $modelClass::create($data);
        $this->audit('created', $config['model'], $item->getKey(), $config['label']);

        return redirect()->route('admin.content.edit', [$resource, $item->getKey()])
            ->with('status', "{$config['label']} item created.");
    }

    public function edit(string $resource, string $id): View
    {
        $config = $this->resource($resource);
        $item = $this->findItem($config, $id);

        return view('admin.content.form', [
            'config' => $config,
            'resource' => $resource,
            'item' => $item,
            'values' => $this->displayValues($item, $config),
        ]);
    }

    public function update(Request $request, string $resource, string $id): RedirectResponse
    {
        $config = $this->resource($resource);
        $item = $this->findItem($config, $id);
        $item->update($this->validatedData($request, $config, $item));
        $this->audit('updated', $config['model'], $item->getKey(), $config['label']);

        return redirect()->route('admin.content.edit', [$resource, $item->getKey()])
            ->with('status', "{$config['label']} item updated.");
    }

    public function destroy(string $resource, string $id): RedirectResponse
    {
        $config = $this->resource($resource);
        $item = $this->findItem($config, $id);
        $this->audit('deleted', $config['model'], $item->getKey(), $config['label']);
        $item->delete();

        return redirect()->route('admin.content.index', $resource)
            ->with('status', "{$config['label']} item deleted.");
    }

    /**
     * @return array<string, mixed>
     */
    private function resource(string $resource): array
    {
        $config = config("admin.resources.{$resource}");
        abort_unless(is_array($config), 404);

        Gate::authorize('access-admin');

        return $config;
    }

    private function findItem(array $config, string $id): Model
    {
        $modelClass = $config['model'];

        return $modelClass::where($config['identifier'], $id)->firstOrFail();
    }

    /**
     * @param  array<string, mixed>  $config
     * @return array<string, mixed>
     */
    private function validatedData(Request $request, array $config, ?Model $item): array
    {
        $rules = [];

        foreach ($config['fields'] as $name => $field) {
            $rules[$name] = array_map(
                fn (mixed $rule): mixed => is_string($rule)
                    ? str_replace('{id}', (string) ($item?->getKey() ?? 'NULL'), $rule)
                    : $rule,
                $field['rules'],
            );
        }

        $validated = $request->validate($rules);
        $data = [];

        foreach ($config['fields'] as $name => $field) {
            $value = $validated[$name] ?? null;

            if ($field['type'] === 'json') {
                if ($value === null || $value === '' || $value === 'null') {
                    $data[$name] = [];

                    continue;
                }

                $decoded = json_decode((string) $value, true);

                if (! is_array($decoded)) {
                    throw ValidationException::withMessages([$name => 'Must be valid JSON.']);
                }

                $data[$name] = $decoded;

                continue;
            }

            if ($field['type'] === 'number') {
                $data[$name] = (int) $value;

                continue;
            }

            $data[$name] = filled($value) ? $value : null;
        }

        return $data;
    }

    /**
     * @param  array<string, mixed>  $config
     * @return array<string, mixed>
     */
    private function displayValues(Model $item, array $config): array
    {
        $values = [];

        foreach ($config['fields'] as $name => $field) {
            $value = $item->getAttribute($name);

            if ($field['type'] === 'json') {
                $value = json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            }

            $values[$name] = $value;
        }

        return $values;
    }

    private function audit(string $action, string $subjectType, int $subjectId, string $label): void
    {
        AuditLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'subject_type' => $subjectType,
            'subject_id' => $subjectId,
            'description' => "{$action} {$label} item #{$subjectId}",
        ]);
    }
}
