<template>
<div>
    <div v-if="!loaded" class="d-flex justify-content-center">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <horizontal-bar-chart v-if="loaded" :height="200" :chartdata="data" :option="options"></horizontal-bar-chart>
</div>
</template>

<script>
    import _ from 'lodash';
    import moment from 'moment';

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
                let formatedData = {
                    labels: _.map(data, (el)=>{return moment(el.date).format('MMMM')}),
                    datasets: [{
                        label: 'My First dataset',
                        data: _.map(data, 'value'),
                    }]

                };
                console.log(formatedData);
                app.data = formatedData;
                app.loaded = true;
            })
            .catch((e)=>{
                console.error(e);
            })
        }
    }
</script>
