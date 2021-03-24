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
            posterPath: "https://image.tmdb.org/t/p/w185"
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
        addShow: function(show) {
            console.log(show);
            const addedShow = {
                name: show.name,
                overview: show.overview,
                first_air_date: show.first_air_date,
                vote_average: show.vote_average,
                original_language: show.original_language,
                user_id: this.auth,
                poster_path: show.poster_path
            };
            // console.log(addedShow);
            axios
                .post("http://localhost:8000/shows", addedShow)
                .then(response => {
                    if (response.status == 200) {
                        console.log("Success, show added", 200);
                    }
                });
        }
    }
};
</script>
