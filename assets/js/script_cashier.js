    var rel1 = new Chart(document.getElementById("rel1"), {
        //tipo de grafico
        type:'line',
        data:{  //dados inserido no grafico
            labels: dia_lista,   //os tipos de informação que vai ter na horizontal
            datasets:[{
                label:'Entrada',
                data:[3,6,4,9, 4, 2 , 3 ],
                fill:false,
                backdropColor: '#0000FF',
                borderColor: '#0000FF'
            },
                {
                    label:'Saída',
                    data:[2, 5, 3, 5, 3, 1, 2],
                    fill:false,
                    backdropColor: '#FF0000',
                    borderColor: '#FF0000'
                },
                {
                    label:'Movimento',
                    data:[3, 6, 2, 6, 2, 1, 4],
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

