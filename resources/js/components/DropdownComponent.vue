<template>
    <div>
        <div class="menu-anchor">
            <a class="cta-button user-button" @click="isOpen = !isOpen">
                {{ user.name }}
                <i class="fas fa-chevron-down"></i>
            </a>
            <transition name="fade" appear>
                <div v-if="isOpen" class="sub-menu">
                    <a class="sub-cta-button" :href="'/dashboard'">
                        Dashboard
                    </a>
                    <a class="sub-cta-button" :href="'/statistics'">
                        Statistiche
                    </a>
                    <a class="sub-cta-button" href="'/logout'" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="/logout" method="POST" class="d-none">
                        <input type="hidden" name="_token" :value="csrf">
                    </form>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
export default {
    name: 'dropdown-component',
    props: ['user'],
    data () {
        return {
            isOpen: false,
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }
}
</script>
