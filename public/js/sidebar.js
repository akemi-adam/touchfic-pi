document.addEventListener('DOMContentLoaded', () => {

    const smenu = document.getElementById('smenu')

    smenu.addEventListener('click', () => {

        const sidebar = document.getElementById('sidebar')

        sidebar.style.transform = "translateX(330px)"

        sidebar.addEventListener('mouseleave', () => {
            sidebar.style.transform = "translateX(-330px)";
        })

    })

})