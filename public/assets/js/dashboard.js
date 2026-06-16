document.addEventListener('DOMContentLoaded', () => {

    const canvas =
        document.getElementById(
            'balanceChart'
        );

    if (!canvas) return;

    const meses = [
        ...new Set([
            ...ingresosData.map(i => i.mes),
            ...gastosData.map(g => g.mes)
        ])
    ].sort();

    const ingresos = meses.map(mes => {

        const item =
            ingresosData.find(
                i => i.mes === mes
            );

        return item
            ? Number(item.total)
            : 0;

    });

    const gastos = meses.map(mes => {

        const item =
            gastosData.find(
                g => g.mes === mes
            );

        return item
            ? Number(item.total)
            : 0;

    });

    new Chart(canvas, {

        type: 'line',

        data: {

            labels: meses,

            datasets: [

                {
                    label: 'Ingresos',
                    data: ingresos,
                    tension: 0.4
                },

                {
                    label: 'Gastos',
                    data: gastos,
                    tension: 0.4
                }

            ]

        }

    });

});