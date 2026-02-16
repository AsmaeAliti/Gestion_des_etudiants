$(document).ready(function () {


    $.ajax({
        url: '/stats/inclusive-organizations',
        type: 'GET',
        dataType: 'json',
        success: function (data) {

            var labels = data.map(item => item.organization_name);
            var dataPoints = data.map(item =>
                parseInt(item.total_males) + parseInt(item.total_females)
            );

            // BAR CHART
            var ctx = $('#BarChart').get(0).getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'مجموع التلاميذ',
                        data: dataPoints,
                        backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            ticks: {
                                precision: 0,
                            }
                        }
                    },
                    // to hide the label
                    plugins: {
                        legend: {
                        display: false
                        }
                    }
                }
            });

            // PIE CHART
            var totalMales = data.reduce((acc, item) => acc + parseInt(item.total_males), 0);
            var totalFemales = data.reduce((acc, item) => acc + parseInt(item.total_females), 0);

            var ctx2 = $('#PieChart').get(0).getContext('2d');
            new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: ['الإناث', 'الذكور'],
                    datasets: [{
                        data: [totalFemales, totalMales],
                        backgroundColor: [
                            'rgba(255, 0, 128, 0.51)', // Red for females
                            'rgba(0, 116, 183, 0.48)', // Blue for males
                        ],
                        borderColor: [
                            'rgba(255,0,128, 1)',
                            'rgba(0,116,183, 1)',
                        ],
                        borderWidth: 1
                    }]
                }
            });

        },
        error: function (xhr, status, error) {
            console.error('Error fetching inclusive organizations:', error);
        }
    });

    $.ajax({
        url: '/stats/disabilities_type',
        type: 'GET',
        dataType: 'json',
        success: function (data) {

            var labels = data.map(item => item.Disability_type);
            var dataPoints = data.map(item => item.total);

            var ctx = $('#LineChart').get(0).getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'عدد حالات الإعاقة',
                        data: dataPoints,
                        fill: false,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        tension: 0.1
                    }]
                },
                options: {
                    scales: {
                        y: { 
                            beginAtZero: true, 
                            ticks: {
                                precision: 0,
                            }
                         }
                    },
                    // to hide the label
                    plugins: {
                        legend: {
                        display: false
                        }
                    }
                }
            });

        },
        error: function (xhr, status, error) {
            console.error('Error fetching disabilities:', error);
        }
    });

}) ;