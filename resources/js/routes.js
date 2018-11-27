import dashboard from './components/dashboard/index.vue'
import proudct from './components/proudct/index.vue'
import storeProudct from './components/storeProudct/index.vue'
import editProudct from './components/editProudct/index.vue'

import slider from './components/slider/index.vue';
import catg from './components/catg/index.vue';


export const routes = 
[
	{
		path:'/',
		name:'dashboard',
		component:dashboard
	},
	{
		path:'/proudct',
		name:'proudct',
		component:proudct
	},
	{
		path:'/storeProudct',
		name:'storeProudct',
		component:storeProudct
	},
	{
		path:'/editProudct/:id',
		name:'editProudct',
		component:editProudct
	},
	{
		path:"/slider",
		name:'slider',
		component:slider
	},
	{
		path:'/catg',
		name:'catg',
		component:catg
	}
]