document.addEventListener('DOMContentLoaded', () => {

    const addBodyLock = () => {
        const body = document.querySelector('body')
        body.classList.add('lock')
    }
    const removeBodyLock = () => {
        const body = document.querySelector('body')
        body.classList.remove('lock')
    }
    const toggleBurger = () => {
        const burger = document.querySelector('.burger')
        const menu = document.querySelector('.menu-body')
        burger.addEventListener('click', () => {
            if (menu.classList.contains('active')) {
                burger.classList.remove('active')
                menu.classList.remove('active')
                removeBodyLock()
            } else {
                burger.classList.add('active')
                menu.classList.add('active')
                addBodyLock()
            }
        })
    }
    toggleBurger()
})