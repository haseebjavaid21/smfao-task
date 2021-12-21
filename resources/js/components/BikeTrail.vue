<template>
	<div class="col-md-8">
        <div class="card">
            <div class="card-header"><h5><b>Bike Data Visaulization</b></h5></div>

            <div class="card-body">
                The table shows important information about the trip plotted on the map
            </div>
            <table class="table table-bordered" style="width:100%;font-size:12px">
            <thead>
                <tr>
                    <th>Distance</th>
                    <th>Average Speed</th>
                    <th>CO2 Saving</th>
                    <th>Duration</th>
                    <th>Trip Start</th>
                    <th>Trip End</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{bikeData.distance}}</td>
                    <td>{{bikeData.average_speed}}</td>
                    <td>{{bikeData.pseudo_co2_saving_g}}</td>
                    <td>{{bikeData.duration_s}} ( in Seconds )</td>
                    <td>{{bikeData.trip_start}}</td>
                    <td>{{bikeData.trip_end}}</td>
                </tr>
            </tbody>
        </table>

            <div id="container" style="width:500px;height:600px;margin-left:20%">

            </div>
        </div>
    </div>
</template>


<script>
    export default {
        name: "HereMap",
        data() {
            return {
                map: {},
                platform: {},
                routingService: {},
                bikeData : [],
                lat: '51.71501',
                lng: '8.75076',
            }
        },
        props: {},
        created() {
            this.platform = new H.service.Platform({
                'apikey': 'GdIJV6a7ZteFg_jMlW1Pv4TaJXwxB7Bevsq9D1KFFqI'
            });
            this.routingService = this.platform.getRoutingService();
        },
        mounted() {
            let defaultLayers = this.platform.createDefaultLayers();
            this.map = new H.Map(
                document.getElementById('container'),
                defaultLayers.vector.normal.map,
                {
                    zoom: 14.75,
                    center: { lat: '51.71501', lng: '8.75076' } 
                }
            );
            this.fetchJsonData();

        },
        methods: { 
            fetchJsonData() {
                axios.get('/api/bikedatajson')
                    .then((response) => {
                        console.log(response.data);
                        this.bikeData = response.data;
                        for(var i = 0 ; i < response.data.datapoints.length-1  ; i++) {
                        console.log(i);
                            this.drawRoutes(response.data.datapoints[i], response.data.datapoints[i+1]);
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },

            forDateTime(datetime) {
                var sec_num = parseInt(datetime, 10); // don't forget the second param
                var hours   = Math.floor(sec_num / 3600);
                var minutes = Math.floor((sec_num - (hours * 3600)) / 60);
                var seconds = sec_num - (hours * 3600) - (minutes * 60);

                if (hours   < 10) {hours   = "0"+hours;}
                if (minutes < 10) {minutes = "0"+minutes;}
                if (seconds < 10) {seconds = "0"+seconds;}
                return hours + ':' + minutes + ':' + seconds;

            },
            drawRoutes(start, finish) {

                let startp = start.lat + "," + start.lng;
                let finsihp = finish.lat + "," + finish.lng;

                this.routingService.calculateRoute(
                    {
                        "mode" : "balanced;bicycle",
                        "waypoint0" : startp,
                        "waypoint1" : finsihp,
                        "representation" : "display"
                    },
                    data => {
                        if(data.response.route.length > 0) {
                            let lineString = new H.geo.LineString();
                            data.response.route[0].shape.forEach(point => {
                                let [lat, lng] = point.split(",");
                                lineString.pushPoint({ lat : lat, lng : lng });
                            });
                            let polyline = new H.map.Polyline(
                                lineString, 
                                {
                                    style : {
                                        lineWidth : 5
                                    }
                            });
                            this.map.addObject(polyline);
                        }
                    },
                    error => {
                        console.error(error);
                    }
                );
            }
        }
    }
</script>