document.getElementById('year').addEventListener('change', function() {
    var selectedYear = this.value;

    if (selectedYear !== '-- Pilih Tahun --') {
        axios.get(`/get-sales-data/${selectedYear}`)
            .then(function(response) {
                var salesData = response.data;

                // Find the selected year in salesData
                var selectedYearData = salesData.find(function(item) {
                    return item.tahun == selectedYear;
                });

                if (selectedYearData) {
                    var totalIncomeInput = document.getElementById('harga');
                    var totalPPHInput = document.getElementById('totalPPH');

                    var totalIncome = selectedYearData.totalPendapatan;
                    totalIncomeInput.value = formatCurrency(totalIncome);

                    var calculatedPPH = calculatePPH(totalIncome);
                    totalPPHInput.value = formatCurrency(calculatedPPH);
                } else {
                    console.error('Data not found for the selected year.');
                }
            })
            .catch(function(error) {
                console.error('Error fetching sales data:', error);
            });
    }
});

function calculatePPH(penghasilan) {
    if (penghasilan <= 50000000) {
        return penghasilan * 0.05;
    } else if (penghasilan <= 250000000) {
        return 50000000 * 0.05 + (penghasilan - 50000000) * 0.15;
    } else if (penghasilan <= 500000000) {
        return 50000000 * 0.05 + (250000000 - 50000000) * 0.15 + (penghasilan - 250000000) * 0.25;
    } else if (penghasilan <= 5000000000) {
        return 50000000 * 0.05 + (250000000 - 50000000) * 0.15 + (500000000 - 250000000) * 0.25 + (penghasilan - 500000000) * 0.30;
    } else {
        return 50000000 * 0.05 + (250000000 - 50000000) * 0.15 + (500000000 - 250000000) * 0.25 + (5000000000 - 500000000) * 0.30 + (penghasilan - 5000000000) * 0.35;
    }
}

function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(amount);
}