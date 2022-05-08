try {
    let element = document.getElementById('select')
    let item = element.children[0]

    item.removeAttribute('href')
    item.classList.replace('nav-link','not-nav-link')
} catch {
    
}
