<?php
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LIMS Oil & Gas Lab Dashboard</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- DataTables CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <!-- Custom Theme for Oil & Gas -->
    <style>
        :root {
            --primary: #102a43;
            --accent: #fbbf24;
            --secondary: #1e293b;
            --bg: #f1f5f9;
            --oil: #22223b;
            --gas: #fbbf24;
        }
        body { background: var(--bg); }
        .custom-accent { color: var(--accent); }
        .custom-bg { background: var(--primary); color: #fff; }
        .oil-bg { background: var(--oil); color: #fbbf24; }
        .gas-bg { background: var(--gas); color: #22223b; }
        .glass {
            background: rgba(255,255,255,0.8);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.1);
            backdrop-filter: blur(4px);
            border-radius: 1rem;
        }
    </style>
</head>
<body class="antialiased font-sans">
    <div class="min-h-screen flex flex-col items-center justify-center p-4" dir="rtl">
        <!-- Header -->
        <div class="w-full max-w-6xl mb-8 flex flex-col md:flex-row items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold custom-accent mb-2">لوحة تحكم مختبر النفط والغاز</h1>
                <p class="text-gray-700">نظام إدارة معلومات المختبرات (LIMS) - Oil & Gas</p>
            </div>
            <img src="https://img.icons8.com/external-flatart-icons-outline-flatarticons/64/000000/external-oil-industry-oil-industry-flatart-icons-outline-flatarticons-1.png" alt="Oil & Gas" class="w-16 h-16 mt-4 md:mt-0">
        </div>
        <!-- Live Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-6xl mb-8">
            <div class="oil-bg rounded-xl p-6 text-center shadow-lg glass">
                <div class="text-4xl font-extrabold" id="stat1">{{ $oilSamplesToday ?? 120 }}</div>
                <div class="mt-2 text-lg font-semibold">عينات النفط اليوم</div>
            </div>
            <div class="gas-bg rounded-xl p-6 text-center shadow-lg glass">
                <div class="text-4xl font-extrabold" id="stat2">{{ $gasInProgress ?? 15 }}</div>
                <div class="mt-2 text-lg font-semibold">تحاليل الغاز قيد التنفيذ</div>
            </div>
            <div class="custom-bg rounded-xl p-6 text-center shadow-lg glass">
                <div class="text-4xl font-extrabold" id="stat3">{{ isset($completionRate) ? round($completionRate, 1) . '%' : '98%' }}</div>
                <div class="mt-2 text-lg font-semibold">نسبة الإنجاز الكلية</div>
            </div>
        </div>
        <!-- Interactive Charts -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 w-full max-w-6xl mb-8">
            <div class="bg-white rounded-xl p-6 shadow-lg glass">
                <h2 class="text-xl font-semibold mb-4 custom-accent">توزيع عينات النفط والغاز خلال الأسبوع</h2>
                <canvas id="samplesChart" height="120"></canvas>
            </div>
            <div class="bg-white rounded-xl p-6 shadow-lg glass">
                <h2 class="text-xl font-semibold mb-4 custom-accent">حالة التحاليل</h2>
                <canvas id="statusChart" height="120"></canvas>
            </div>
        </div>
        <!-- Data Table -->
        <div class="bg-white rounded-xl p-6 shadow-lg glass w-full max-w-6xl">
            <h2 class="text-xl font-semibold mb-4 custom-accent">جدول بيانات العينات</h2>
            <div class="overflow-x-auto">
                <table id="samplesTable" class="display w-full">
                    <thead>
                        <tr>
                            <th>رقم العينة</th>
                            <th>النوع</th>
                            <th>الحالة</th>
                            <th>تاريخ الاستلام</th>
                            <th>الموقع</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($samples))
                            @foreach($samples as $sample)
                                <tr>
                                    <td>{{ $sample->id }}</td>
                                    <td>{{ $sample->type }}</td>
                                    <td>{{ $sample->status }}</td>
                                    <td>{{ $sample->received_at }}</td>
                                    <td>{{ $sample->location }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>OG-1001</td>
                                <td>نفط خام</td>
                                <td>مكتمل</td>
                                <td>2025-05-29</td>
                                <td>حقل الزبير</td>
                            </tr>
                            <tr>
                                <td>OG-1002</td>
                                <td>غاز طبيعي</td>
                                <td>قيد التنفيذ</td>
                                <td>2025-05-29</td>
                                <td>حقل الرميلة</td>
                            </tr>
                            <tr>
                                <td>OG-1003</td>
                                <td>نفط خام</td>
                                <td>مرفوض</td>
                                <td>2025-05-28</td>
                                <td>حقل غرب القرنة</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Dashboard Scripts -->
    <script>
        // تمرير بيانات الرسوم البيانية من PHP إلى JavaScript أو بيانات افتراضية
        const oilChart = @json($oilChart ?? [12, 19, 14, 17, 20, 23, 21]);
        const gasChart = @json($gasChart ?? [8, 11, 9, 10, 12, 15, 13]);
        const weekDays = @json($weekDays ?? ['السبت','الأحد','الإثنين','الثلاثاء','الأربعاء','الخميس','الجمعة']);
        const statusChart = @json(array_values($statusChart ?? ['مكتمل'=>70,'قيد التنفيذ'=>20,'مرفوض'=>10]));

        // Oil & Gas Samples Chart
        new Chart(document.getElementById('samplesChart'), {
            type: 'bar',
            data: {
                labels: weekDays,
                datasets: [
                    {
                        label: 'عينات النفط',
                        data: oilChart,
                        backgroundColor: 'rgba(34,34,59,0.8)'
                    },
                    {
                        label: 'عينات الغاز',
                        data: gasChart,
                        backgroundColor: 'rgba(251,191,36,0.8)'
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { labels: { font: { family: 'Figtree' } } }
                },
                scales: {
                    x: { ticks: { font: { family: 'Figtree' } } },
                    y: { beginAtZero: true, ticks: { font: { family: 'Figtree' } } }
                }
            }
        });

        // Analysis Status Chart
        new Chart(document.getElementById('statusChart'), {
            type: 'doughnut',
            data: {
                labels: ['مكتمل', 'قيد التنفيذ', 'مرفوض'],
                datasets: [{
                    data: statusChart,
                    backgroundColor: ['#22c55e', '#fbbf24', '#ef4444']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { labels: { font: { family: 'Figtree' } } }
                }
            }
        });

        // DataTable
        $(document).ready(function() {
            $('#samplesTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/ar.json'
                }
            });
        });

        // Live Statistics Example (simulate live updates)
        setInterval(() => {
            document.getElementById('stat1').textContent = {{ $oilSamplesToday ?? 120 }} + Math.floor(Math.random()*10);
            document.getElementById('stat2').textContent = {{ $gasInProgress ?? 15 }} + Math.floor(Math.random()*5);
            document.getElementById('stat3').textContent = (95 + Math.floor(Math.random()*5)) + '%';
        }, 5000);
    </script>
</body>
</html>
