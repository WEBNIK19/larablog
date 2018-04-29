<template>
	<div class="container">
			<div class="row">
				<div v-for="post in PagePosts" class="panel panel-default">
				<div class="panel-heading"><div class="panel-title">{{post.header}}</div></div>
				<div class="panel-body">{{post.demo}}</div>
				<div class="panel-footer">{{post.created_at}}</div>
			</div>	
		</div>
	</div>

</template>
<script>
	export default{
		watch:{
			'$route'(to,from){
				if(this.$route.params.action === 'all'){
					console.log('all');
					this.$store.dispatch('getAllPosts',{
							data:
							{
								page: this.$route.params.page, 
								per_page: "5",
							}
						}
					);
					
				}else if(this.$route.params.action === 'today'){
					console.log('today');
					this.$store.dispatch('getTodayPosts',{
							data:
							{
								page: this.$route.params.page, 
								per_page: "5",
							}
						}
					);
				} else if(this.$route.params.action === 'user'){
					console.log('user');
					this.$store.dispatch('getUsersPosts',{
							data:
							{
								page: this.$route.params.page, 
								per_page: "5",
							}
						}
					);
				}
			}
		},
		computed:{
			PagePosts(){
				return this.$store.getters.PagePosts;
			}

		},
		mounted(){
				if(this.$route.params.action === 'all'){
					console.log('all');
					this.$store.dispatch('getAllPosts',{
							data:
							{
								page: this.$route.params.page, 
								per_page: "5",
							}
						}
					);
					
				}else if(this.$route.params.action === 'today'){
					console.log('today');
					this.$store.dispatch('getTodayPosts',{
							data:
							{
								page: this.$route.params.page, 
								per_page: "5",
							}
						}
					);
				} else if(this.$route.params.action === 'user'){
					console.log('user');
					this.$store.dispatch('getUsersPosts',{
							data:
							{
								page: this.$route.params.page, 
								per_page: "5",
							}
						}
					);
				}
			},
	};
</script>