<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Sales Performance Dashboard</title>
</head>
<body>
    <header>
        <div class="logo">My Company</div>
        <h1>Sales Performance Dashboard</h1>
        <div class="user-profile">User Avatar</div>
        <input type="date" id="date-range" />
    </header>
    <aside class="sidebar">
        <nav>
            <ul>
                <li>Overview</li>
                <li>Reports</li>
                <li>Analytics</li>
                <li>Settings</li>
            </ul>
        </nav>
    </aside>
    <main>
        <section class="live-stats">
            <div class="stat-card">Total Sales: $10,000</div>
            <div class="stat-card">New Customers: 150</div>
            <div class="stat-card">Total Revenue: $50,000</div>
            <div class="stat-card">Conversion Rate: 5%</div>
        </section>
        <section class="charts">
            <canvas id="salesLineChart"></canvas>
            <canvas id="salesBarChart"></canvas>
            <canvas id="marketSharePieChart"></canvas>
        </section>
        <section class="data-table">
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Customer Name</th>
                        <th>Product</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Data rows will be populated here -->
                </tbody>
            </table>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 My Company. All rights reserved.</p>
    </footer>
</body>
</html>