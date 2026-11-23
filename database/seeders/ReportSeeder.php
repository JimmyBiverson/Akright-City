<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Support\LegacyAsset as Asset;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        $reports = [
            [2026, 'Financial Reports', 'ACRA Q2 Half_Year_Financial_Report_Jan-Jun_2026_final.pdf', 'reports/2026/Financial Reports/ACRA Q2 Half_Year_Financial_Report_Jan-Jun_2026_final.pdf'],
            [2026, 'Financial Reports', 'ACRA_Q1_2026_Financial_Report.pdf 1.pdf', 'reports/2026/Financial Reports/ACRA_Q1_2026_Financial_Report.pdf 1.pdf'],
            [2026, 'Financial Reports', 'Akright Run 26 UNGANISHA summary FINANCIAL REPORT.pdf', 'reports/2026/Financial Reports/Akright Run 26 UNGANISHA summary FINANCIAL REPORT.pdf'],
            [2026, 'Financial Reports', 'Akright Run Unganisha 26 full Financial Report.pdf', 'reports/2026/Financial Reports/Akright Run Unganisha 26 full Financial Report.pdf'],
            [2026, 'Project Reports', 'No reports available.', null],
            [2026, 'Village Reports', 'ACRA Annual general meeting.pdf', 'reports/2026/Village Reports/ACRA Annual general meeting.pdf'],
            [2026, 'Village Reports', 'EXECUTIVE VILLAGE - Half year Report 2026.pdf', 'reports/2026/Village Reports/EXECUTIVE VILLAGE - Half year Report 2026.pdf'],
            [2026, 'Village Reports', 'Rhine Village_2026 Mid Year Report_FINAL Draft.pdf', 'reports/2026/Village Reports/Rhine Village_2026 Mid Year Report_FINAL Draft.pdf'],
            [2026, 'Village Reports', 'Suncity H1 report.pdf', 'reports/2026/Village Reports/Suncity H1 report.pdf'],
            [2026, 'Executive Reports', 'High Level Financial Report Q1 2026.pdf', 'reports/2026/Executive Reports/High Level Financial Report Q1 2026.pdf'],
            [2026, 'Executive Reports', "President's Report - H1- Updated.pdf", "reports/2026/Executive Reports/President's Report - H1- Updated.pdf"],
            [2026, 'Events Reports', 'No reports available.', null],
            [2025, 'Financial Reports', 'ACRA AUDITED BOOKS OF ACCOUNTS 2025.pdf', 'reports/2025/Financial Reports/ACRA AUDITED BOOKS OF ACCOUNTS  2025.pdf'],
            [2025, 'Project Reports', 'No reports available.', null],
            [2025, 'Village Reports', 'No reports available.', null],
            [2025, 'Executive Reports', 'No reports available.', null],
            [2025, 'Events Reports', 'No reports available.', null],
            [2024, 'Financial Reports', 'ACRA Audited Report 2024.pdf', 'reports/2024/Financial Reports/ACRA Audited Report 2024.pdf'],
            [2024, 'Project Reports', 'No reports available.', null],
            [2024, 'Village Reports', 'No reports available.', null],
            [2024, 'Executive Reports', 'No reports available.', null],
            [2024, 'Events Reports', 'No reports available.', null],
        ];

        $sortOrder = 1;

        foreach ($reports as [$year, $category, $title, $path]) {
            Report::create([
                'year' => $year,
                'category' => $category,
                'title' => $title,
                'path' => $path === null ? null : Asset::url($path),
                'sort_order' => $sortOrder++,
            ]);
        }
    }
}
