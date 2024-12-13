const bankCard = document.querySelectorAll(".bank-card");

const observerOptions = {
    root: null,
    rootMargin: "0px",
    threshold: 0.1,
}

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting){
            entry.target.classList.add('visible');
        }
    });
}, observerOptions);

bankCard.forEach(card => {
    observer.observe(card);
})
