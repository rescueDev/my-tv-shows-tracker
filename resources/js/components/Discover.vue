<template>
    <div class="container">
        <div class="row">
            <h3 class="mt-4">
                Trending Shows
            </h3>
            <div
                class="col-12 d-flex justify-content-between mt-1 overflow-auto"
            >
                <div
                    class="results mr-2"
                    :key="show.id"
                    v-for="show in trending"
                >
                    <img
                        class="rounded-sm poster"
                        :src="posterPath + show.poster_path"
                        alt=""
                    />
                    <i class="far fa-plus-square" @click="addShow(show)"></i>
                </div>
            </div>
        </div>
        <div class="row">
            <h3 class="mt-4">
                Discover Shows
            </h3>
            <div
                class="col-12 d-flex justify-content-between mt-1 overflow-auto"
            >
                <div
                    class="results mr-2"
                    :key="show.id"
                    v-for="show in discover"
                >
                    <img
                        class="rounded-sm poster"
                        :src="posterPath + show.poster_path"
                        alt=""
                    />
                    <i class="far fa-plus-square" @click="addShow(show)"></i>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: "Find",
    props: {
        auth: Number
    },
    data() {
        return {
            trending: [],
            discover: [],
            posterPath: "https://image.tmdb.org/t/p/w185",
            details: [],
            showToAdd: ''
        };
    },
    created: function() {
        //trending shows
        console.log(this.auth);
        axios
            .get("https://api.themoviedb.org/3/trending/tv/day", {
                params: {
                    api_key: `${process.env.MIX_VUE_APP_TMDB_KEY}`
                }
            })
            .then(r => {
                const results = r.data.results;
                this.trending = results;
            });
        //discover shows
        axios
            .get("https://api.themoviedb.org/3/discover/tv", {
                params: {
                    api_key: `${process.env.MIX_VUE_APP_TMDB_KEY}`
                }
            })
            .then(r => {
                // console.log(r.data);
                const results = r.data.results;
                this.discover = results;
            });
    },
    methods: {
        async addShow(show) {
            // console.log(show);
            var episodes = [];

            try {
                const singleShow = await axios.get(`https://api.themoviedb.org/3/tv/${show.id}`, {
                        params: {
                            api_key: `${process.env.MIX_VUE_APP_TMDB_KEY}`
                        }
                    })

                const results = singleShow.data;

                //get and attach episodes for each season
                for (let s = 1;  s <= results.number_of_seasons; s++ ) {

                    axios.get(`https://api.themoviedb.org/3/tv/${show.id}`, {
                                params: {
                                  api_key: `${process.env.MIX_VUE_APP_TMDB_KEY}`,
                                  append_to_response: `season/${s}`
                                }})
                          .then(response => {
                                let risposta = response.data;
                                const stag = risposta[`season/${s}`];
                                episodes.push(stag);
                          })
                }

                //show to add before post call
                this.showToAdd = {
                    name: results.name,
                    overview: results.overview,
                    first_air_date: results.first_air_date,
                    vote_average: results.vote_average,
                    original_language: results.original_language,
                    user_id: this.auth,
                    poster_path: results.poster_path,
                    status: results.status,
                    seasons: results.seasons,
                    season_number: results.number_of_seasons,
                    episodes: episodes
                }

            } catch (err) {
                console.log(err);
            }

            // console.log(this.showToAdd);

            //post call, save in db
            axios
                .post("http://localhost:8000/shows", this.showToAdd)
                .then(() => {
                    console.log("Success, show added", 200);
                });
        }
    },
}
</script>
