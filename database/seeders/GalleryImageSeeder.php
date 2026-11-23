<?php

namespace Database\Seeders;

use App\Models\GalleryImage;
use App\Support\LegacyAsset as Asset;
use Illuminate\Database\Seeder;

class GalleryImageSeeder extends Seeder
{
    public function run(): void
    {
        $rows = [];

        $this->add($rows, 2026, 'Youth Day', 'Youth Day Photo', [
            'WhatsApp Image 2026-02-11 at 1.24.34 PM.jpeg',
            'WhatsApp Image 2026-02-11 at 1.24.36 PM.jpeg',
            'WhatsApp Image 2026-02-11 at 1.24.37 PM (1).jpeg',
            'WhatsApp Image 2026-02-11 at 1.24.37 PM.jpeg',
            'WhatsApp Image 2026-02-11 at 1.24.39 PM.jpeg',
        ]);

        $runImages = [
            'IMG_7981.jpg',
            'IMG_8127.jpg',
            'IMG_8199.jpg',
            'IMG_8281.jpg',
            'IMG_8327.jpg',
            'IMG_8475.jpg',
            'IMG_8529.jpg',
            'IMG_8618.jpg',
            'IMG_8695.jpg',
        ];

        foreach ([
            ['19.32.38', []], ['19.32.39', [1]], ['19.32.40', [1, 2]], ['19.32.41', [1]],
            ['19.32.42', [1, 2]], ['19.32.43', [1]], ['19.32.44', [1, 2, 3, 4]], ['19.32.45', [1, 2]],
            ['19.32.46', [1, 2]], ['19.32.47', [1, 2]], ['19.32.48', [1, 2]], ['19.32.49', [1, 2, 3]],
            ['19.32.50', [1, 2]], ['19.32.51', [1, 2]], ['19.32.52', [1, 2]], ['19.32.53', [1, 2]],
            ['19.32.54', [1, 2]], ['19.32.55', [1, 2, 3, 4]], ['19.32.56', []],
            ['19.58.12', [1, 2]], ['19.58.13', [1, 2]], ['19.58.14', [1, 2]], ['19.58.15', [1, 2, 3]],
            ['19.58.16', [1, 2, 3, 4]], ['19.58.17', [1]], ['19.58.18', [1, 2]], ['19.58.19', [1, 2]],
            ['19.58.20', [1, 2]], ['19.58.21', [1, 2]], ['19.58.22', [1, 2]], ['19.58.23', []],
            ['21.10.11', [1]], ['21.10.12', [1]], ['21.10.13', []], ['21.10.14', []], ['21.10.15', []],
            ['21.10.16', [1]], ['21.10.17', [1, 2]], ['21.10.18', [1]], ['21.10.19', [1]], ['21.10.20', [1]],
            ['21.10.21', [1]], ['21.10.22', []], ['21.10.23', [1]], ['21.10.24', [1]], ['21.10.25', [1]],
            ['21.10.26', []], ['21.10.27', [1, 2, 3]], ['21.10.28', [1]], ['21.10.29', []], ['21.10.30', [1]],
            ['21.10.31', [1]], ['21.10.32', [1]], ['21.10.33', [1, 2]], ['21.10.34', [1]],
        ] as [$time, $variants]) {
            $runImages = array_merge($runImages, $this->whatsapp($time, $variants));
        }

        $this->add($rows, 2026, 'Akright Run', 'Akright Run Photo', $runImages);

        $footballOrder = array_merge([1], range(10, 19), [2], range(20, 29), range(3, 9));
        $footballImages = [];

        foreach ($footballOrder as $number) {
            $footballImages[] = "WhatsApp Image 2026-11-10 at 13.13.05 ({$number}).jpeg";
        }

        $footballImages[] = 'WhatsApp Image 2026-11-10 at 13.13.05.jpeg';
        $footballImages = array_merge($footballImages, [
            '04904cf1-6fb7-4df6-a329-2e42e231164f.JPG',
            '23685bde-368c-438e-b40d-9fd283e8c07a.JPG',
            '2c828551-bece-4ba3-a213-4bd5fec972fa.JPG',
            '4a2d5bb5-457a-4b86-8797-99764ae1a0c4.JPG',
            '7a62732b-fbc4-4130-9b6a-95db8be40cd3.JPG',
            '88500e6c-0bc8-4d1a-a942-60ecfeb8b81e.JPG',
            '90dcd6d4-7b85-430c-9e3e-acd5b64c56d1.JPG',
            '9a11c179-4990-4066-89ed-2fe9525687e8.JPG',
            'b2ad5753-3725-49c9-849c-cd745e85e251.JPG',
            'b46882fc-7bec-4fec-94bb-5277794224c2.JPG',
            'c577379f-747f-45cf-bcea-b8db1defb166.JPG',
            'c723e691-bc79-443c-9f74-917dc9c68893.JPG',
            'e8f0cae8-0bad-48fc-b807-38337a4daa3f.JPG',
            'eb1a9367-e769-40e8-a66c-d46cc549a3d3.JPG',
            'f5018588-3aff-4e39-8d69-e9c7f3d9e596.JPG',
            'f5a3bc09-d78b-4501-85af-6ea61afc029d.JPG',
            'fedd72bd-0b36-4846-9d6a-bac64c557a42.JPG',
        ]);

        $this->add($rows, 2026, 'ACRA Football tournament', 'ACRA Football tournament Photo', $footballImages);

        $mensNumbers = [803, 804, 811, 812, 818, 822, 826, 828, 831, 833, 836, 843, 846, 849, 851, 852, 855, 857, 858, 861, 862, 863, 865, 866, 869, 873, 874, 876, 879, 883, 884, 886, 888, 896, 898, 901, 904, 906, 908, 910, 914, 917, 918, 919, 924, 927, 929, 933, 936, 937, 938, 940, 944, 948, 951, 952, 958, 962, 965, 966, 969, 970, 971, 973, 974, 980, 981, 984, 989, 990, 994, 995, 999, 1003, 1006, 1008, 1013, 1016, 1018, 1025, 1029, 1034, 1039, 1043, 1045, 1048, 1050, 1051, 1057, 1060, 1062, 1065, 1066, 1070, 1073, 1074, 1077, 1081, 1083, 1084, 1089, 1096, 1106, 1110, 1111, 1112, 1118, 1120, 1122, 1126, 1128, 1130, 1132, 1135, 1136, 1140, 1141, 1143, 1150, 1153, 1154, 1158, 1160, 1162, 1163, 1165, 1176, 1181, 1182, 1187, 1191, 1196, 1205, 1206, 1209, 1214, 1220, 1222, 1224, 1233, 1235];
        $mensImages = array_map(
            fn (int $number): string => 'DEN_'.str_pad((string) $number, 4, '0', STR_PAD_LEFT).'.jpg',
            $mensNumbers,
        );

        $this->add($rows, 2026, 'Mens Day', 'Mens Day Photo', $mensImages);

        $this->add($rows, 2026, 'Womens Day', 'Womens Day Photo', [
            'N49A2642.JPG', 'N49A2678_1.JPG', 'N49A2743.JPG', 'N49A2791.JPG', 'N49A2803.JPG',
            'N49A2823.JPG', 'N49A2828.JPG', 'N49A2841.JPG', 'N49A2931.JPG', 'N49A2937.JPG',
            'N49A2955.JPG', 'N49A2983.JPG', 'N49A3002.JPG', 'N49A3078.JPG', 'N49A3080.JPG',
            'N49A3148.JPG', 'N49A3161.JPG', 'N49A3163.JPG', 'N49A3168.JPG', 'N49A3174.JPG',
            'N49A3208.JPG', 'N49A3285.JPG', 'N49A3286.JPG', 'N49A3292.JPG', 'N49A3298.JPG',
            'N49A3338.JPG', 'N49A3339.JPG', 'N49A3346.JPG', 'N49A3355(1).JPG', 'N49A3358.JPG',
            'N49A3360.JPG', 'N49A3414.JPG', 'N49A3466.JPG', 'N49A3467.JPG', 'N49A3581.JPG',
            'N49A3596.JPG', 'N49A3640.JPG', 'N49A3648.JPG', 'N49A3650.JPG', 'N49A3660.JPG',
            'N49A3679.JPG', 'N49A3698.JPG', 'N49A3699.JPG', 'N49A3715.JPG', 'N49A3725.JPG',
            'N49A3733.JPG', 'N49A3738.JPG',
        ]);

        foreach ($rows as $row) {
            GalleryImage::create($row);
        }
    }

    /**
     * @param  array<int, array<string, mixed>>  $rows
     * @param  array<int, string>  $names
     */
    private function add(array &$rows, int $year, string $category, string $title, array $names): void
    {
        foreach ($names as $name) {
            $rows[] = [
                'year' => $year,
                'category' => $category,
                'title' => $title,
                'path' => Asset::url("images/gallery/{$year}/{$category}/{$name}"),
                'alt_text' => $title,
                'sort_order' => count($rows) + 1,
            ];
        }
    }

    /**
     * @param  array<int, int>  $variants
     * @return array<int, string>
     */
    private function whatsapp(string $time, array $variants): array
    {
        $names = [];

        foreach ($variants as $variant) {
            $names[] = "WhatsApp Image 2026-05-12 at {$time} ({$variant}).jpeg";
        }

        $names[] = "WhatsApp Image 2026-05-12 at {$time}.jpeg";

        return $names;
    }
}
