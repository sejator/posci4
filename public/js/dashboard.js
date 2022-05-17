$(function () {
  'use strict'
  let pesan = $("#pesan").data('pesan');
  if (pesan) {
      Swal.fire({
          title: pesan,
          icon: 'error',
          showConfirmButton: false,
          timer: 1500
      })
  }
  $.getJSON(`${BASE_URL}/dashboard/laporan`, function (data) {
      let label = [];
      let total = [];
      $(data).each(function (i) {
          label.push(data[i].bulan)
          total.push(data[i].total)
      })
      let ctx = document.getElementById("laporan-penjualan");
      let myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: label,
              datasets: [
                  {
                      label: 'Total Penjualan',
                      backgroundColor: 'rgba(54, 162, 235, 100)',
                      borderColor: 'rgba(54, 162, 235, 100)',
                      data: total
                  }
              ]
          },
          options: {
              scales: {
                  yAxes: [{
                      ticks: {
                          beginAtZero: true
                      }
                  }]
              }
          }
      });
  })
})
