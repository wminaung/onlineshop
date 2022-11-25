
const myNavLink = document.querySelectorAll('.my-nav-link');
const eventHaldler = (event) => {
    // console.log(event.type)
    if (event.type == 'mouseover') {
        event.target.classList.add('active');
        return;
    }
    if (event.type == 'mouseout') {
        event.target.classList.remove('active');
        return;
    }


}
myNavLink.forEach((link) => {
    link.addEventListener('mouseover', eventHaldler)
    link.addEventListener('mouseout', eventHaldler)
})
