    var rel1 = new Chart(document.getElementById("rel1"), {
        //tipo de grafico
        type:'line',
        data:{  //dados inserido no grafico
            labels: days_list,   //os tipos de informação que vai ter na horizontal
            datasets:[{
                label:'Entrada',
                data:input_list,
                fill:false,
                backdropColor: '#0000FF',
                borderColor: '#0000FF'
            },
                {
                    label:'Saída',
                    data:[100, 150, 3, 450, 5, 150, 220],
                    fill:false,
                    backdropColor: '#FF0000',
                    borderColor: '#FF0000'
                },
                {
                    label:'Movimento',
                    data:[39, 69, 20, 650, 200, 100, 49],
                    fill:false,
                    backgroundColor: '#008000',
                    borderColor: '#008000'
                }

            ]  //especificando as informações da vertical


        }
    });

var rel2 = new Chart(document.getElementById("rel2"), {
    type: 'pie',
    data:{
        labels:['Entrada', 'Saida', 'Retirada'],
        datasets: [{
            data:[7, 3, 5],
            backgroundColor:['#36A2EB','#FFCE56', '#FF6384']
        }]
    }
});

