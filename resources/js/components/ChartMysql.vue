<template>
<div>
    <horizontal-bar-chart v-if="loaded" :height="200" :chartdata="data" :option="options"></horizontal-bar-chart>
</div>
</template>

<script>
    import _ from 'lodash';

    export default {
        data: function () {
            return {
                loaded: false,
                data: {},
                options: {
					elements: {
						rectangle: {
							borderWidth: 2,
						}
					},
					responsive: true,
					legend: {
						position: 'right',
					},
					title: {
						display: true,
						text: 'My Mysql dataset'
					}
				}
            }
        },
        async mounted() {
            let app = this;
            app.loaded = false;

            axios.get('/api/v1/data')
            .then((res)=> {
                let data = res.data;
                app.data = {
                    labels: data.labels,
                    datasets: data.data
                };
                app.loaded = true;
            })
            .catch((e)=>{
                console.error(e);
            })
        }
    }
</script>
