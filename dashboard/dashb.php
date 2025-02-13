<?php
session_start(); // Start the session

// Check if the admin is logged in
if (!isset($_SESSION['admin_username'])) {
    header("Location: adminlogin.php"); // Redirect to login page if not logged in
    exit();
}
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./table-style.css"> <!-- Table-specific CSS -->
</head>

<style>.sidebar-menu {
    list-style: none;
    padding: 0;
    width: 250px; /* Adjust width as needed */
}

.sidebar-menu li {
    background-color: #FF4255; /* Button background */
    padding: 12px 20px;
    margin: 8px 0;
    text-align: center;
    border-radius: 8px;
    font-size: 18px;
    font-weight: bold;
    transition: 0.3s;
    width:180px;
}

.sidebar-menu li a {
    text-decoration: none;
    color: white; /* White text */
    display: block;
}

.sidebar-menu li:hover {
    background-color: #d13344; /* Darker shade on hover */
    transform: scale(1.05);
}
.logout-button {
    display: inline-block;
    padding: 13px 24px;  /* Reduced padding */
    background-color:#0a0a0a;
    color: white;
    font-size: 14px;  /* Smaller font */
    font-weight: bold;
    border: none;
    border-radius: 4px; /* Slightly rounded corners */
    text-decoration: none;
    cursor: pointer;
    transition: background 0.3s, transform 0.2s;
    width:100px;
    margin-left: 1500px;
}

.logout-button:hover {
    background-color:#000000;
    transform: scale(1.05);
}

</style>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div>
                <div class="sidebar-header">
                    <h2>Admin</h2>
                </div>
                <ul class="sidebar-menu">
                    <li class="active"><a href="../status/status.html">📊 Dashboard</a></li>
                    <li><a href="../status/status.html">✔️ Completed</a></li>
                    <li><a href="../status/status.html">⌛️ Pending</a></li>
                    <li><a href="../status/status.html">🚧 In Progress</a></li>
                    <li><a href="../status/status.html">❌ Overdue</a></li>
                    
                </ul>
                
                
            </div>
            
        </aside>
        <main class="main-content">
            
            <section class="content">
                <h2>WELCOME ADMIN</h2>
                <a href="logout.php" class="logout-button">Logout</a>
                <h3>Enquiries Table</h3>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Comment</th>
                                <th>Enquiry Type</th>
                                <th>Status</th> <!-- Added Status Header -->
                            </tr>
                        </thead>
                        <tbody id="table-data">
                            <!-- Data will be inserted here -->
                        </tbody>
                        
                    </table>
                </div>
                
            </section>
            <!-- <section class="chart-card">
                <h3>Profit & Expenses</h3>
                <canvas id="barChart"></canvas>
            </section> -->
        </main>
    </div>


    <script>
       document.addEventListener("DOMContentLoaded", function (
       ) {
    fetch("fetch_inquiries.php")
        .then(response => response.json())
        .then(data => {
            console.log("Fetched Data:", data); // Debugging line

            let tableBody = document.getElementById("table-data");
            tableBody.innerHTML = "";

            if (!Array.isArray(data) || data.length === 0) {
                tableBody.innerHTML = "<tr><td colspan='6'>No records found</td></tr>";
                return;
            }

            data.forEach(row => {
                tableBody.innerHTML += `
                    <tr>
                        <td>${row.name}</td>
                        <td>${row.email}</td>
                        <td>${row.phone}</td>
                        <td>${row.comment}</td>
                        <td>${row.inquiry_type}</td>
<td>
    <select class="status-dropdown" data-id="${row.id}">
        <option value="Completed" ${row.statuss === "Completed" ? "selected" : ""}> Completed</option>
        <option value="Pending" ${row.statuss === "Pending" ? "selected" : ""}> Pending</option>
        <option value="In Progress" ${row.statuss === "In Progress" ? "selected" : ""}> In Progress</option>
        <option value="Overdue" ${row.statuss === "Overdue" ? "selected" : ""}> Overdue</option>
    </select>
</td>
                    </tr>
                    
                `;
            });
        })
        .catch(error => {
            console.error("Fetch error:", error);
            document.getElementById("table-data").innerHTML = "<tr><td colspan='6'>Error loading data</td></tr>";
        });
});

    </script>
    

</body>

</html>