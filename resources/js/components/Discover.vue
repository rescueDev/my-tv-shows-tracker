<template>
    <div class="container-fluid">

<!--        <div v-show="loading" class="lds-ring"><div></div><div></div><div></div><div></div></div>-->
        <div  v-show="loading" class="loader-container">
            <div class="loader"></div>
        </div>

        <!--   search bar-->
        <div class="row">
            <nav class="navbar navbar-light bg-light">
                <form class="form-inline" @submit.prevent="search">
                    <input v-model="input" class="form-control mr-md-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit" >Search</button>
                </form>
            </nav>
        </div>


        <div v-if="!searching" class="row">
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
        <div v-if="!searching" class="row">
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

<!--        Search Results-->
        <div v-else class="row mx-auto">
            <h3 class="mt-4">
                Results
            </h3>
            <div
                class="col-sm-12 d-flex flex-wrap justify-content-evenly mt-1"
            >
                <div
                    class="results mr-3 mt-3 mb-3"
                    :key="show.id"
                    v-for="show in searched"
                >
                    <img v-if="show.poster_path"
                        class="rounded-sm poster"
                        :src="posterPath + show.poster_path"
                        alt=""
                    />
                    <img v-else
                         class="rounded-sm poster"
                         :src="'/public/notfound.jpg'"
                         alt="poster"
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
            showToAdd: {},
            epArray: [],
            searched: [],
            input: "",
            page: 1,
            searching: false,
            loading: false
        };
    },
    created: function() {
        //trending shows
        // console.log(this.auth);
        this.loading = true;

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

            this.loading = false;

    },
    methods: {
        async addShow(show) {
            // console.log(show);
            this.loading = true;
            const episodes = [];

            try {

                    const singleShow = await axios.get(`https://api.themoviedb.org/3/tv/${show.id}`, {
                        params: {
                            api_key: `${process.env.MIX_VUE_APP_TMDB_KEY}`
                        }
                    })


                const results = singleShow.data;

                //get and attach episodes for each season
                for (let s = 1;  s <= results.number_of_seasons; s++ ) {

                    var getEpisodes = await axios.get(`https://api.themoviedb.org/3/tv/${show.id}`, {
                        params: {
                            api_key: `${process.env.MIX_VUE_APP_TMDB_KEY}`,
                            append_to_response: `season/${s}`
                        }});

                    const getEpData =  getEpisodes.data;
                    let stag = getEpData[`season/${s}`];
                    // console.log(stag);
                    this.epArray.push(stag);
                }

                // console.log('epArray', this.epArray)
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
                    backdrop_path: results.backdrop_path,
                    episodes: this.epArray
                }

                console.log('episodi prima del post',this.showToAdd);

                //post call, save in db
                axios
                    .post("http://localhost:8000/shows", this.showToAdd)
                    .then((r) => {
                        console.log(r.data);
                        this.epArray = [];
                        this.showToAdd = [];
                        console.log("Success, show added", 200);
                        this.loading= false;
                    });

            } catch (err) {
                console.log(err);
            }
        },
        async search() {
            this.searching = true;
            this.loading = true;

            try {


                const research = await axios.get("https://api.themoviedb.org/3/search/tv", {
                    params: {
                        api_key: `${process.env.MIX_VUE_APP_TMDB_KEY}`,
                        query: this.input,
                        page: this.page
                    }
                });
                const results = research.data.results
                // console.log(results);
                this.searched = results;
                this.input = "";
                this.loading = false;

                // console.log(this.searched);
            }
            catch (e) {
                console.log(e);
            }
        }
    },

}
</script>
