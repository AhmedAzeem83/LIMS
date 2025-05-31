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
        <div class="user-profile">User</div>
        <div class="notifications">🔔</div>
        <div class="datetime">2023-10-01 12:00 PM</div>
    </header>
    <aside>
        <nav>
            <ul>
                <li>Home</li>
                <li>Analytics</li>
                <li>Reports</li>
                <li>Settings</li>
            </ul>
        </nav>
    </aside>
    <main>
        <section class="live-stats">
            <div class="stat-card">Total Sales: $10,000</div>
            <div class="stat-card">New Customers: 50</div>
            <div class="stat-card">Conversion Rate: 5%</div>
            <div class="stat-card">Average Order Value: $200</div>
        </section>
        <section class="charts">
            <canvas id="salesTrendChart"></canvas>
            <canvas id="categorySalesChart"></canvas>
        </section>
        <section class="data-table">
            <input type="text" placeholder="Search...">
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Order Date</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dynamic rows will be inserted here -->
                </tbody>
            </table>
            <div class="pagination">1 | 2 | 3</div>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 My Company. All rights reserved.</p>
    </footer>
    <script src="script.js"></script>
</body>
</html>