<template>
  <div class="container">

<router-link 
  style="position: relative;
    top: 10px;
    right: 30px;
    font-size: 26px;
    font-weight:bold" 
    class="md-inset md-list-item" :to="{name:'createCategory'}">Add categories</router-link>
     

    <md-field>
      <label>search</label>
      <md-input v-model="searchTerm"></md-input>
    </md-field>


    <div class="full-control">
    <div class="list" v-for="category in filtersearch" :key="category.id">
    
 
          <span class="md-list-item-text">{{category.title}}</span> 

              <router-link class="md-inset md-list-item" :to="{name:'editCategory',params:{id:category.id}}">Edit</router-link><br>
          <a  @click="deleteCategory(category.id)"  style="cursor: pointer" >Delete</a>
        
   
    </div>
  </div>  
</div>
</template>

<script>
export default{
    created(){
     if (!User.loggedIn()) {
        this.$router.push({name: '/'})
      }
    },
     data:()=>({
  
        categories:[],
        searchTerm:''
      
    }),
    computed:{
      filtersearch(){
        return this.categories.filter(category=> {
          return category.title.match(this.searchTerm)
        })
      }
    },
   
    methods:{
  

      allcategories(){
          axios.get('/api/category')
          .then(({data})=>{this.categories=data.categories,console.log(this.categories)})
               .catch((err) => {
                console.log(err);
               })
      },
      deleteCategory(id){
        if(User.Role()=='user'){
         alert('delet avilable for admins only');
         this.$router.push({name:'category'})
        }else{
        axios.delete('/api/category/'+id)
        .then(() => {
                this.categories = this.categories.filter(category => {
                  return category.id != id
                })
               })
               .catch(() => {
            
               })
      }}
    },
    created(){
       this.allcategories();
    }
}
</script>

<style lang="scss" scoped>
  $list-width: 320px;

  .full-control {
    display: flex;
    flex-direction: row;
    flex-wrap: wrap-reverse;
  }

  .list {
    width: 100%;
  }

  .full-control > .md-list {
    width: $list-width;
    max-width: 100%;
    height: 400px;
    display: inline-block;
    overflow: auto;
    border: 1px solid rgba(#000, .12);
    vertical-align: top;
  }

  .control {
    min-width: 100%;
    display: flex;
    flex-direction: column;
    padding: 16px;
  }
</style>
