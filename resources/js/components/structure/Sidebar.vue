<template>
  <nav class="col-md-2 d-none d-md-block bg-dark sidebar">
    <div class="sidebar-sticky">
      <menuComponent></menuComponent>
    </div>
  </nav>
</template>
<script>
import MenuComponent from "./Menu.vue";

export default {
  name: "sidebar",
  components: {
    MenuComponent,
  },
};
</script>

<style scoped>
.sidebar {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  z-index: 100;
  padding: 0;
  box-shadow: inset -1px 0 0 rgba(0, 0, 0, 0.1);
}

.sidebar-sticky {
  /*position: -webkit-sticky;*/
  position: fixed;
  top: 48px;
  height: calc(100vh - 48px);
  padding-top: 0.5rem;
  overflow-x: hidden;
  overflow-y: auto;
}

.sidebar .nav-link {
  font-weight: 500;
  color: #333;
}

.sidebar .nav-link .feather {
  margin-right: 4px;
  color: #999;
}

.sidebar .nav-link.active {
  /*color: #007bff;*/
  color: white !important;
}

.sidebar .nav-link:hover .feather,
.sidebar .nav-link.active .feather {
  scale: 2 !important;
}

.sidebar-heading {
  font-size: 0.75rem;
  text-transform: uppercase;
}

.a:hover {
  color: red !important;
}

/* Medium devices (tablets, 768px and up) */
@media (min-width: 768px) and (max-width: 991.98px) {
  .sidebar {
    width: 200px;
    max-width: 200px;
  }
}

/* Large devices (desktops, 992px and up) */
@media (min-width: 992px) and (max-width: 1199.98px) {
  .sidebar {
    width: 200px;
    max-width: 200px;
  }
}

/* Extra large devices (large desktops, 1200px and up) */
@media (min-width: 1200px) {
  .sidebar {
    width: 220px;
    max-width: 220px;
  }
}
</style>
