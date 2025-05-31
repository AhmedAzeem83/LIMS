<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Performance Dashboard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">Logo</div>
        <h1>Sales Performance Dashboard</h1>
        <div class="user-profile">User Avatar</div>
        <div class="date-range-picker">Date Range Picker</div>
    </header>
    <aside class="sidebar">
        <nav>
            <ul>
                <li>Overview</li>
                <li>Sales</li>
                <li>Customers</li>
                <li>Products</li>
                <li>Reports</li>
            </ul>
        </nav>
    </aside>
    <main>
        <section class="live-statistics">
            <div class="stat-card">Total Sales: $X <span>% Change</span></div>
            <div class="stat-card">Total Customers: Y <span>% Change</span></div>
            <div class="stat-card">Total Products: Z <span>% Change</span></div>
            <div class="stat-card">Average Order Value: $A <span>% Change</span></div>
        </section>
        <section class="charts">
            <div class="chart" id="line-chart"></div>
            <div class="chart" id="bar-chart"></div>
            <div class="chart" id="pie-chart"></div>
            <div class="chart" id="area-chart"></div>
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
                    <!-- Data Rows -->
                </tbody>
            </table>
            <div class="pagination">Pagination Controls</div>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 Company Name. All rights reserved.</p>
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Service</a>
        <a href="#">Help Center</a>
    </footer>
    <script src="scripts.js"></script>
</body>
</html>