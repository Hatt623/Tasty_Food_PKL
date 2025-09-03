const lendingchart = new ApexCharts(document.querySelector("#lendingchart"), {
  series: [
    {
      name: "Pending",
      data: [] // akan diisi oleh fetch
    },
    {
      name: "Success",
      data: [] // akan diisi juga
    }
  ],
  chart: {
    type: 'bar',
    height: 310,
    toolbar: { show: false },
  },
  colors: ['#ffc107', '#28a745'],
  plotOptions: {
    bar: {
      borderRadius: 4,
      columnWidth: '40%',
    }
  },
  dataLabels: { enabled: false },
  xaxis: {
    categories: [], // tanggal diisi dari backend
    labels: {
      style: {
        fontSize: '14px'
      }
    }
  },
  tooltip: {
    theme: 'dark',
    y: {
      formatter: function (val) {
        return val + " returns";
      }
    }
  }
});

lendingchart.render();

async function loadChartData() {
  try {
    const response = await fetch('/chartlending-data'); // route kamu
    const data = await response.json();

    lendingchart.updateOptions({
      xaxis: {
        categories: data.labels
      }
    });

    lendingchart.updateSeries([
      {
        name: 'Pending',
        data: data.pending
      },
      {
        name: 'Success',
        data: data.success
      }
    ]);

  } catch (err) {
    console.error('Gagal ambil data chart:', err);
  }
}

window.addEventListener("DOMContentLoaded", loadChartData);