<template>
  <div>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <ul class="navbar-nav">
        <li class="nav-item" v-if="user">
          <span class="nav-link pointer">{{ user.name }}</span>
        </li>
        <li class="nav-item">
          <router-link to="/" class="nav-link">Projects</router-link>
        </li>
        <li class="nav-item">
          <router-link to="/parameters" class="nav-link">Parameters</router-link>
        </li>
        <li class="nav-item">
          <router-link to="/instruction" class="nav-link">How to use</router-link>
        </li>
        <li class="nav-item" v-if="user">
          <span class="nav-link pointer" v-on:click="logout">Logout</span>
        </li>
        <li class="nav-item" v-else>
          <a v-on:click="auth()" class="nav-link pointer">SigIn with Google</a>
        </li>
      </ul>
    </nav>
    <br/>
    <div class="container-fluid main">
      <router-view></router-view>
    </div>
    <footer class="footer bg-dark">
      <div class="footer-content">
        <b>Owned by NULP. {{ (new Date).getFullYear() }}.</b>
        <a target="_blank" href="https://www.linkedin.com/in/stepan-skopivskyi-187687140">Developed By @Skopa.</a>
      </div>
    </footer>

    <notifications group="app" position="bottom left" :speed="500"></notifications>

    <div v-bind:class="{'loader-container': loader}">
      <div class="loader">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "App",

  data() {
    return {
      user: null,
      client_id: null,
      loader: true
    }
  },

  created() {
    this.axios.get('/api/user')
        .then(response => this.user = response.data.data)
        .catch(() => console.info('Unauthorized.'));

    this.axios.interceptors.request.use(
        conf => {
          this.loader = true;
          return conf;
        },
        error => {
          this.loader = false;
          return Promise.reject(error);
        }
    );
    this.axios.interceptors.response.use(
        response => {
          this.loader = false;
          return response;
        },
        error => {
          this.loader = false;
          return Promise.reject(error);
        }
    );

  },

  methods: {
    onError(err) {
      this.$notify({group: 'app', type: 'error', title: 'Auth', text: err.toString()});
      console.warn(err);
    },
    logout() {
      this.axios.post('/api/logout').then(() => {
        this.user = null;
        this.$notify({group: 'app', type: 'success', title: 'Logout', text: 'Logout successful.'});
      });
    },
    login(token) {
      this.axios.post('/api/auth', {token})
          .then(response => {
            this.user = response.data.data;
            this.$notify({group: 'app', type: 'success', title: 'Auth', text: 'Logged successful.'});
          })
          .catch(err => this.onError(err));
    },
    auth() {
      Vue.googleAuth().directAccess();
      Vue.googleAuth().signIn(
          user => this.login(user.getAuthResponse().access_token),
          err => this.onError(err)
      );
    }
  }
}
</script>

<style scoped>
.pointer {
  cursor: pointer;
}

.main {
  min-height: calc(100vh - 150px);
}

.footer {
  margin-top: 30px;
  padding: 10px;
  display: flex;
  justify-content: center;
  color: lightgray;
}
</style>
