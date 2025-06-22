<?php
/* Template Name: Demography Page */
get_template_part('template-parts/header');
?>
<?php custom_breadcrumbs(); ?>
<style>
/* --- Your CSS as you posted --- */
.payoff {
    background: #f4f8f9;
    padding: 2.5rem;
    margin-top: 2rem;
    text-align: center;
    width: 100%;
    max-width: 100%;
}
.payoff h2 {
    color: rgb(0, 155, 190);
    letter-spacing: 0.03em;
    position: relative;
}
.payoff h2:after {
    content: '';
    display: block;
    width: 50px;
    height: 1px;
    background: #fd153a;
    margin: 10px auto 0;
}
.payoff p {
    max-width: 440px;
    color: #009bbe;
    margin: 0 auto 1.25rem;
    font-size: 1.2em;
}
.chart-container {
    max-width: 800px;
    margin: 2rem auto;
    padding: 1rem;
}
.card-container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
    padding: 2rem;
    max-width: 1200px;
    margin: 0 auto;
}
#demographicChart {
    width: 100% !important;
    height: 100% !important;
}
.card {
    background: #ffffff;
    border-radius: 10px;
    padding: 1.5rem;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}
.card i {
    font-size: 2rem;
    margin-bottom: 1rem;
}
.card h3 {
    font-size: 1.25rem;
    margin-bottom: 1rem;
}
.card p {
    font-size: 1rem;
    line-height: 1.5;
}
.card.primary {
    background: #e3f2fd;
    border-left: 5px solid #009bbe;
}
.card.primary i, .card.primary h3 {
    color: #009bbe;
}
.card.secondary {
    background: #fce4ec;
    border-left: 5px solid #fd153a;
}
.card.secondary i, .card.secondary h3 {
    color: #fd153a;
}
@media (max-width: 768px) {
    .card-container {
        grid-template-columns: 1fr;
    }
}
</style>

<!-- Payoff Section -->
<div class="payoff">
    <h2><?php echo get_theme_mod('demography_page_title', 'LOVEMATTERS AFRICA'); ?></h2>
    <p><?php echo get_theme_mod('demography_page_description', 'Blush-free facts and stories about love, sex, and relationships'); ?></p>
</div>

<!-- Bar Graph Section -->
<div class="chart-container">
    <canvas id="demographicChart"></canvas>
</div>

<!-- Card Container -->
<div class="card-container">
    <!-- Primary Audience Card -->
    <div class="card primary">
        <i class="fas fa-users"></i>
        <h3>Primary Audience</h3>
        <p><?php echo get_theme_mod('primary_audience_description', 'Young people 18-35 years old in all their diversity.'); ?></p>
    </div>

    <!-- Secondary Audience Card -->
    <div class="card secondary">
        <i class="fas fa-handshake"></i>
        <h3>Secondary Audience</h3>
        <p><?php echo get_theme_mod('secondary_audience_description', 'Parents, guardians, and key decision-makers.'); ?></p>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Fetching dynamic data from PHP
const demographicData = {
    labels: <?php echo get_theme_mod('age_groups', json_encode(["18-35 Years", "35-44 Years", "44-55 Years", "55+ Years"])); ?>, // Dynamic data
    datasets: [{
        label: "User Demographics",
        data: <?php echo get_theme_mod('demographic_data', json_encode([80, 10, 6, 4])); ?>, // Dynamic data
        backgroundColor: ["#009bbe", "#fd153a", "#ffc107", "#28a745"],
        borderColor: ["#009bbe", "#fd153a", "#ffc107", "#28a745"],
        borderWidth: 1
    }]
};

// Chart Configuration
const config = {
    type: 'bar',
    data: demographicData,
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
            title: {
                display: true,
                text: 'User Demographics by Age Group',
                font: { size: 18 }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                title: { display: true, text: 'Percentage (%)' }
            },
            x: {
                title: { display: true, text: 'Age Groups' }
            }
        }
    }
};

// Render Chart
const demographicChart = new Chart(
    document.getElementById('demographicChart'),
    config
);
</script>

<?php get_template_part('template-parts/footer'); ?>