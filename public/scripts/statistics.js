$(document).ready(function () {
    
    // BAR CHART ( students number ased on organizations ) 
    var ctx = $('#BarChart').get(0).getContext('2d');
    var chart1 = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [],
            datasets: [{
                label: 'مجموع التلاميذ',
                data: [],
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
            responsive: true,
            maintainAspectRatio: false,  // <-- add this
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

    // PIE CHART ( Student number based on gender )
    var ctx2 = $('#PieChart').get(0).getContext('2d');
    var chart2 = new Chart(ctx2, {
        type: 'pie',
        data: {
            labels: ['الإناث', 'الذكور'],
            datasets: [{
                data: [],
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
    
    // LINE CHART ( student number based on disability type )
    var ctx3 = $('#LineChart').get(0).getContext('2d');
    var chart3 = new Chart(ctx3, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'عدد حالات الإعاقة',
                data: [],
                fill: false,
                borderColor: 'rgba(75, 192, 192, 1)',
                tension: 0.2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,  // <-- add this
            transitions: {
                active: {
                    animation: {
                        duration: 2000
                    }
                }
            },

            scales: {
                y: { 
                    beginAtZero: true, 
                    ticks: { precision: 0, }
                }
            },
            // to hide the label
            plugins: {
                legend: { display: false }
            }
        }
    });


    $.ajax({
        url: '/stats/inclusive-organizations',
        type: 'GET',
        dataType: 'json',
        success: function (data) {

            var dataPoints = data.map(item =>
                parseInt(item.total_males) + parseInt(item.total_females)
            );

            chart1.data.labels = data.map(item => item.organization_name);
            chart1.data.datasets[0].data = dataPoints ;
            chart1.update();

            // PIE CHART
            var totalMales = data.reduce((acc, item) => acc + parseInt(item.total_males), 0);
            var totalFemales = data.reduce((acc, item) => acc + parseInt(item.total_females), 0);

            chart2.data.datasets[0].data = [ totalFemales, totalMales ];
            chart2.update();

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

            chart3.data.labels = data.map(item => item.Disability_type);
            chart3.data.datasets[0].data = data.map(item => item.total);
            chart3.update();

        },
        error: function (xhr, status, error) {
            console.error('Error fetching disabilities:', error);
        }
    });

}) ;