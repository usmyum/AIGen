import Alpine from 'alpinejs';
import {focus} from '@alpinejs/focus';
import {persist} from '@alpinejs/persist';
// import {collapse} from '@alpinejs/collapse';
import ajax from '@imacrayon/alpine-ajax';

import './bootstrap';

window.Alpine = Alpine;

Alpine.plugin([persist, ajax, focus]);

// Generator V2
Alpine.data('generatorV2', () => ({
	itemsSearchStr: '',
	setItemsSearchStr(str) {
		this.itemsSearchStr = str.trim().toLowerCase()
		if ( this.itemsSearchStr !== '' ) {
			this.$el.closest('.lqd-generator-sidebar').classList.add('lqd-showing-search-results')
		} else {
			this.$el.closest('.lqd-generator-sidebar').classList.remove('lqd-showing-search-results')
		}
	},
	sideNavCollapsed: false,
	/**
	 *
	 * @param {'collapse' | 'expand'} state
	 */
	toggleSideNavCollapse( state ) {
		this.sideNavCollapsed = state ? (state === 'collapse' ? true : false) : !this.sideNavCollapsed

		if ( this.sideNavCollapsed ) {
			tinymce?.activeEditor?.focus();
		}
	},
	generatorStep: 0,
	setGeneratorStep( step ) {
		if ( step === this.generatorStep ) return;
		if (!document.startViewTransition) {
			return this.generatorStep = Number( step )
		}
		document.startViewTransition(() => this.generatorStep = Number( step ));
	},
	selectedGenerator: null
}));


// Chat
Alpine.store('mobileChat', {
	sidebarOpen: false,
	toggleSidebar( state ) {
		this.sidebarOpen = state ? (state === 'collapse' ? false : false) : !this.sidebarOpen
	}
})

Alpine.start();