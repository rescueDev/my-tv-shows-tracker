<template>
    <div class="container-fluid">
        <loading
            :active.sync="isLoading"
            :can-cancel="true"
            :is-full-page="fullPage"
        >
        </loading>

        <!--   search bar-->
        <div class="row d-flex justify-content-center">
            <nav class="navbar navbar-light bg-light">
                <form class="form-inline" @submit.prevent="search">
                    <input
                        v-model="input"
                        class="form-control mr-md-2"
                        type="search"
                        placeholder="Search"
                        aria-label="Search"
                    />
                    <button
                        class="btn btn-outline-success my-2 my-sm-0"
                        type="submit"
                    >
                        Search
                    </button>
                </form>
            </nav>
        </div>

        <h3 class="mt-4">
            Trending Shows
        </h3>
        <carousel
            v-if="!searching"
            class="story-carousel story-carousel--colors story-carousel--multiple row mx-auto"
            :hideArrowsOnBound="true"
        >
            <slide
                class="story-carousel__slide col-sm-12 col-md-4 col-lg-2 results"
                :key="show.id"
                v-for="show in trending"
            >
                <img
                    class="rounded-sm poster"
                    :src="posterPath + show.poster_path"
                    alt=""
                />
                <i class="far fa-plus-square" @click="addShow(show)"></i>
            </slide>
        </carousel>

        <h3 class="mt-4">
            New Shows
        </h3>
        <carousel
            v-if="!searching"
            class="vs-carousel story-carousel story-carousel--multiple story-carousel--images row mx-auto"
            :hideArrowsOnBound="true"
        >
            <slide
                class="story-carousel__slide col-sm-12 col-md-4 col-lg-2"
                :key="show.id"
                v-for="show in discover"
            >
                <img
                    class="rounded-sm poster"
                    :src="posterPath + show.poster_path"
                    alt=""
                />
                <i class="far fa-plus-square" @click="addShow(show)"></i>
            </slide>
        </carousel>

        <!-- Search Results-->
        <div v-else class="row mx-auto">
            <div class="col-sm-12 d-flex flex-wrap justify-content-evenly mt-1">
                <div
                    class="results mr-3 mt-3 mb-3"
                    :key="show.id"
                    v-for="show in searched"
                >
                    <img
                        v-if="show.poster_path"
                        class="rounded-sm poster"
                        :src="posterPath + show.poster_path"
                        alt=""
                    />
                    <div v-else class="no-poster-container">
                        <img
                            class="rounded-sm poster"
                            :src="'/notfound.jpg'"
                            alt="poster"
                            width="185px"
                        />
                        <h5 class="notfound-title">{{ show.name }}</h5>
                    </div>
                    <i class="far fa-plus-square" @click="addShow(show)"></i>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
// Import component
import Loading from "vue-loading-overlay";
import { Carousel, Slide } from "vue-snap";
import "vue-snap/dist/vue-snap.css";

export default {
    name: "Find",
    props: {
        auth: Number
    },
    components: {
        Loading,
        Carousel,
        Slide
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
            loading: false,
            isLoading: false,
            fullPage: true,
            loader: "bars"
        };
    },
    created: function() {
        //trending shows
        this.isLoading = true;
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
                const results = r.data.results;
                this.discover = results;
                this.isLoading = false;
            });
    },
    methods: {
        async addShow(show) {
            try {
                this.isLoading = true;
                const singleShow = await axios.get(
                    `https://api.themoviedb.org/3/tv/${show.id}`,
                    {
                        params: {
                            api_key: `${process.env.MIX_VUE_APP_TMDB_KEY}`
                        }
                    }
                );

                const results = singleShow.data;

                //get and attach episodes for each season
                for (let s = 1; s <= results.number_of_seasons; s++) {
                    var getEpisodes = await axios.get(
                        `https://api.themoviedb.org/3/tv/${show.id}`,
                        {
                            params: {
                                api_key: `${process.env.MIX_VUE_APP_TMDB_KEY}`,
                                append_to_response: `season/${s}`
                            }
                        }
                    );

                    const getEpData = getEpisodes.data;
                    let stag = getEpData[`season/${s}`];
                    this.epArray.push(stag);
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
                    backdrop_path: results.backdrop_path,
                    episodes: this.epArray
                };

                console.log("episodi prima del post", this.showToAdd);

                //post call, save in db
                axios
                    .post("http://localhost:8000/shows", this.showToAdd)
                    .then(r => {
                        console.log(r.data);
                        this.epArray = [];
                        this.showToAdd = [];
                        console.log("Success, show added", 200);
                        this.isLoading = false;
                    })
                    .catch(error => {
                        console.log("errors: ", error);
                        this.isLoading = false;
                    });
            } catch (err) {
                console.log(err);
                this.isLoading = false;
            }
        },
        async search() {
            this.searching = true;
            this.isLoading = true;

            try {
                const research = await axios.get(
                    "https://api.themoviedb.org/3/search/tv",
                    {
                        params: {
                            api_key: `${process.env.MIX_VUE_APP_TMDB_KEY}`,
                            query: this.input,
                            page: this.page
                        }
                    }
                );

                const results = research.data.results;
                this.searched = results;
                this.input = "";
                this.isLoading = false;
            } catch (e) {
                console.log(e);
                this.isLoading = false;
            }
        }
    }
};
</script>
