<template>
  <div class="container">
    <div class="row justify-content-end my-3">
      <div class="col-md-2">
        <button class="btn btn-primary" @click="product_create">Create</button>
      </div>
      <div class="col-md-6">
        <form action="" class="d-flex">
          <div class="input-group">
            <input
              type="text"
              placeholder="Search"
              class="form-control"
              v-model="search"
            />
          </div>
          <div class="input-group-append">
            <button
              type="submit"
              class="btn btn-primary"
              @click.prevent="products_view"
            >
              Search
            </button>
          </div>
        </form>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">
            {{ !isEdit ? "Create" : "Edit" }}
          </div>
          <div class="card-body">
            <form >
              <label for="">Name:</label>
              <input
                type="text"
                class="form-control"
                v-model="product.name"
                value="product.name"
                :class="{'is-invalid' : product.errors.has('name')}"
              />
              <div class="text-danger" v-if="product.errors.has('name')" v-html="product.errors.get('name')"/>
              <label for="">Price:</label>
              <input
                type="text"
                class="form-control"
                v-model="product.price"
                value="product.price"
                :class="{'is-invalid' : product.errors.has('price')}"
              />
              <div class="text-danger" v-if="product.errors.has('price')" v-html="product.errors.get('price')"/>
              <button
                type="submit"
                class="btn btn-primary mt-3"
                v-if="!isEdit"
                @click.prevent="product_create"
              >
                Create
              </button>
              <button
                type="submit"
                class="btn btn-primary mt-3"
                v-else
                @click.prevent="product_edit()"
              >
                Edit
              </button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <table class="table">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Action</th>
          </tr>
          <tr v-for="product in products.data" :key="product.id">
            <td>{{ product.id }}</td>
            <td>{{ product.name }}</td>
            <td>{{ product.price }}</td>
            <td>
              <button class="btn btn-primary" @click="product_edit(product)">
                Edit
              </button>
              <button
                class="btn btn-danger"
                @click="product_delete(product.id)"
              >
                Delete
              </button>
            </td>
          </tr>
        </table>

        <pagination
          :data="products"
          @pagination-change-page="products_view"
        ></pagination>
      </div>
    </div>
  </div>
</template>

<script>
 
export default {
  data() {
    return {
      search: "",
      isEdit: false,
      products: {},
      product: new Form({
        id: "",
        name: "",
        price: ""
      })
    };
  },
  methods: {
    products_view(page = 1) {
      axios.get(`api/product?page=${page}&search=${this.search}`).then(response => {
        this.products = response.data;
      });
    },

    product_create() {
      if (this.isEdit) {
        this.product.clear();
        this.isEdit = false;
        this.product.reset();
      } else {
        this.product.post("/api/product").then(response => {
          this.products_view();
          this.product.reset();
          Swal.fire({
            title: "Congrat! You have Created new Data.",
            icon: "success",
            confirmButtonText: "Okay"
          });
        }).catch(err => {
          Swal.fire({
            title: "Opps! This Can't Created.",
            icon: "error",
            confirmButtonText: "Okay"
          });
        });
      }
    },

    product_edit(product) {
      if (product) {
        this.isEdit = true;
        this.product.clear();
        this.product.fill(product);
      } else {
        this.product
          .put(`/api/product/${this.product.id}`)
          .then(response => {
            this.product.reset();
            this.products_view();
            Swal.fire({
              title: "Congrat! You have edited.",
              icon: "success",
              confirmButtonText: "Okay"
            });
          })
          .catch(err => {
            this.product.reset();
            Swal.fire({
              title: "Ohh! Data Not Found!",
              icon: "error",
              confirmButtonText: "Okay"
            });
          });
      }
    },

    product_delete($id) {
      Swal.fire({
        title: "Are you sure?",
        text: "You will not be able to recover this data!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Delete",
        cancelButtonText: "Cancle"
      }).then(result => {
        if (result.value) {
          Swal.fire(
            "Deleted!",
            "Your imaginary file has been deleted.",
            "success"
          );
          axios.delete(`/api/product/${$id}`).then(response => {
            this.products_view();
          });
        }
      });
    }

    // product_search()
  },
  created() {
    this.products_view();
  }
};
</script>