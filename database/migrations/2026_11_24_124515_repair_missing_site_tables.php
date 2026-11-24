<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->createUsersTables();
        $this->createCacheTables();
        $this->createJobTables();
        $this->createPageContentsTable();
        $this->createVillagesTable();
        $this->createTeamMembersTable();
        $this->createDirectoryEntriesTable();
        $this->createNewsPostsTable();
        $this->createReportsTable();
        $this->createGalleryImagesTable();
        $this->createVideosTable();
        $this->createFaqsTable();
        $this->createPartnersTable();
        $this->createContactMessagesTable();
        $this->createMediaTable();
        $this->createAuditLogsTable();
        $this->addMissingColumns();
    }

    public function down(): void {}

    private function createIfMissing(string $table, callable $schema): void
    {
        if (Schema::hasTable($table)) {
            return;
        }

        Schema::create($table, $schema);
    }

    private function createUsersTables(): void
    {
        $this->createIfMissing('users', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        $this->createIfMissing('password_reset_tokens', function (Blueprint $table): void {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        $this->createIfMissing('sessions', function (Blueprint $table): void {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    private function createCacheTables(): void
    {
        $this->createIfMissing('cache', function (Blueprint $table): void {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->bigInteger('expiration')->index();
        });

        $this->createIfMissing('cache_locks', function (Blueprint $table): void {
            $table->string('key')->primary();
            $table->string('owner');
            $table->bigInteger('expiration')->index();
        });
    }

    private function createJobTables(): void
    {
        $this->createIfMissing('jobs', function (Blueprint $table): void {
            $table->id();
            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedSmallInteger('attempts');
            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });

        $this->createIfMissing('job_batches', function (Blueprint $table): void {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('total_jobs');
            $table->integer('pending_jobs');
            $table->integer('failed_jobs');
            $table->longText('failed_job_ids');
            $table->mediumText('options')->nullable();
            $table->integer('cancelled_at')->nullable();
            $table->integer('created_at');
            $table->integer('finished_at')->nullable();
        });

        $this->createIfMissing('failed_jobs', function (Blueprint $table): void {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('connection');
            $table->string('queue');
            $table->longText('payload');
            $table->longText('exception');
            $table->timestamp('failed_at')->useCurrent();
            $table->index(['connection', 'queue', 'failed_at']);
        });
    }

    private function createPageContentsTable(): void
    {
        $this->createIfMissing('page_contents', function (Blueprint $table): void {
            $table->id();
            $table->string('key')->unique();
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('hero_image')->nullable();
            $table->longText('body_html')->nullable();
            $table->json('data')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamps();
        });
    }

    private function createVillagesTable(): void
    {
        $this->createIfMissing('villages', function (Blueprint $table): void {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('tagline')->nullable();
            $table->string('chairperson')->nullable();
            $table->longText('chairperson_message')->nullable();
            $table->longText('body_html')->nullable();
            $table->string('map_image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->string('card_image')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    private function createTeamMembersTable(): void
    {
        $this->createIfMissing('team_members', function (Blueprint $table): void {
            $table->id();
            $table->string('group');
            $table->string('name');
            $table->string('role')->nullable();
            $table->string('location')->nullable();
            $table->string('photo')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
            $table->index(['group', 'sort_order']);
        });
    }

    private function createDirectoryEntriesTable(): void
    {
        $this->createIfMissing('directory_entries', function (Blueprint $table): void {
            $table->id();
            $table->string('category');
            $table->string('name');
            $table->text('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->text('details')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
            $table->index(['category', 'sort_order']);
        });
    }

    private function createNewsPostsTable(): void
    {
        $this->createIfMissing('news_posts', function (Blueprint $table): void {
            $table->id();
            $table->string('slug')->unique();
            $table->string('title');
            $table->date('published_at');
            $table->string('image')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('body_html')->nullable();
            $table->string('link')->nullable();
            $table->string('link_label')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    private function createReportsTable(): void
    {
        $this->createIfMissing('reports', function (Blueprint $table): void {
            $table->id();
            $table->year('year');
            $table->string('category');
            $table->string('title');
            $table->text('path')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
            $table->index(['year', 'category', 'sort_order']);
        });
    }

    private function createGalleryImagesTable(): void
    {
        $this->createIfMissing('gallery_images', function (Blueprint $table): void {
            $table->id();
            $table->year('year');
            $table->string('category');
            $table->string('title');
            $table->text('path');
            $table->string('alt_text')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
            $table->index(['year', 'category', 'sort_order']);
        });
    }

    private function createVideosTable(): void
    {
        $this->createIfMissing('videos', function (Blueprint $table): void {
            $table->id();
            $table->string('title');
            $table->string('video_id')->nullable();
            $table->string('url')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    private function createFaqsTable(): void
    {
        $this->createIfMissing('faqs', function (Blueprint $table): void {
            $table->id();
            $table->text('question');
            $table->longText('answer');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    private function createPartnersTable(): void
    {
        $this->createIfMissing('partners', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('logo');
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    private function createContactMessagesTable(): void
    {
        $this->createIfMissing('contact_messages', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('subject')->nullable();
            $table->longText('message');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    private function createMediaTable(): void
    {
        $this->createIfMissing('media', function (Blueprint $table): void {
            $table->id();
            $table->string('path');
            $table->string('original_name');
            $table->string('mime');
            $table->unsignedBigInteger('size');
            $table->string('alt_text')->nullable();
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    private function createAuditLogsTable(): void
    {
        $this->createIfMissing('audit_logs', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('action');
            $table->string('subject_type')->nullable();
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    private function addMissingColumns(): void
    {
        if (Schema::hasTable('users') && ! Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table): void {
                $table->string('role')->default('viewer');
            });
        }

        if (Schema::hasTable('videos') && ! Schema::hasColumn('videos', 'video_id')) {
            Schema::table('videos', function (Blueprint $table): void {
                $table->string('video_id')->nullable();
            });
        }
    }
};
