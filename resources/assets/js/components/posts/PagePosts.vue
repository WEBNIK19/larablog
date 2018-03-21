<template>
	<div class="container">
			<div class="row">
				<div v-for="post in PagePosts" class="panel panel-default">
				<div class="panel-heading"><div class="panel-title">{{post.title}}</div></div>
				<div class="panel-body">{{post.demo}}</div>
				<div class="panel-footer">{{post.created_at}}</div>
			</div>	
		</div>
	</div>

</template>
<script>
	export default{
		computed:{
			PagePosts(){
				return this.$store.getters.PagePosts;
			}
		},
		mounted(){
			
			this.$store.dispatch('getAllPosts',{
				data:
				{
					page: this.$route.params.page, 
					per_page: "5",
				}
			}
				);
			
		}
	};
</script>