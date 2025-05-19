<template>
  <div>
    <navigation></navigation>
    <sidebar></sidebar>
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 main">
      <router-view></router-view>
    </main>
  </div>
</template>

<script>
</script>

<style scoped>
/* Medium devices (tablets, 768px and up) */
@media (min-width: 768px) and (max-width: 991.98px) {
  .main {
    margin: 0px !important;
    margin-left: 200px !important;
    margin-right: 0 !important;
    padding-right: 1.5rem !important;
    padding-left: 1.5rem !important; /* 180 + 40 */
    width: auto;
    max-width: 100%;
  }
}
@media (min-width: 992px) and (max-width: 1199.98px) {
  .main {
    margin: 0px !important;
    margin-left: 200px !important;
    margin-right: 0 !important;
    padding-right: 1.5rem !important;
    padding-left: 1.5rem !important; /* 180 + 40 */
    width: auto;
    max-width: 100%;
  }
}
/* XL devices (desktops, 992px and up) */
@media (min-width: 1200px) {
  .main {
    margin: 0px !important;
    margin-left: 220px !important;
    margin-right: 0 !important;
    padding-right: 1.5rem !important;
    padding-left: 1.5rem !important; /* 180 + 40 */
    width: auto;
    max-width: 100%;
  }
}
</style>