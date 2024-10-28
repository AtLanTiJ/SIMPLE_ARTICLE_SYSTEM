<?php
session_start();
if ($_SESSION['group'] == 'admin') {
?>
    <!DOCTYPE html>
    <html lang="zh-CN">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>仪表板 - 管理员系统</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f4f4f4;
            }

            .dashboard-container {
                padding: 20px;
                background: #fff;
                margin: 20px;
                border-radius: 5px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            .dashboard-header {
                padding-bottom: 20px;
                border-bottom: 1px solid #eee;
                margin-bottom: 20px;
            }

            .dashboard-header h1 {
                color: #50b3a2;
                margin: 0;
            }

            .card {
                background: #fff;
                padding: 20px;
                border-radius: 5px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                margin-bottom: 20px;
            }

            .card-header {
                font-size: 1.2em;
                color: #50b3a2;
                margin-bottom: 10px;
            }

            .card-content {
                font-size: 1em;
                color: #333;
            }

            canvas {
                width: 100% !important;
                max-width: 600px;
                margin: 20px 0;
            }
        </style>
    </head>

    <body>
        <div class="dashboard-container">

            <div class="card">
                <div class="card-header">用户统计</div>
                <div class="card-content">总数: <span id="user-count">加载中...</span></div>
            </div>

            <div class="card">
                <div class="card-header">文章统计</div>
                <div class="card-content">总数: <span id="article-count">加载中...</span></div>
            </div>

            <div class="card">
                <div class="card-header">评论统计</div>
                <div class="card-content">总数: <span id="comment-count">加载中...</span></div>
            </div>

            <div class="card">
                <div class="card-header">用户活跃度</div>
                <canvas id="activityChart"></canvas>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // 模拟获取数据
            function fetchData() {
                // 假设这些数据是从服务器动态获取的
                const userData = {
                    total: 150
                };
                const articleData = {
                    total: 95
                };
                const commentData = {
                    total: 230
                };

                document.getElementById('user-count').textContent = userData.total;
                document.getElementById('article-count').textContent = articleData.total;
                document.getElementById('comment-count').textContent = commentData.total;
            }

            fetchData();

            // 活动图表
            const ctx = document.getElementById('activityChart').getContext('2d');
            const activityChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['一', '二', '三', '四', '五', '六', '日'],
                    datasets: [{
                        label: '用户活跃度',
                        data: [12, 19, 3, 5, 2, 3, 9],
                        backgroundColor: 'rgba(80, 179, 162, 0.2)',
                        borderColor: 'rgba(80, 179, 162, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
    </body>

    </html>



<?php
} else {
    echo "404 Not Found";
}
