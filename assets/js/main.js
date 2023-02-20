const characters = document.querySelectorAll(".selected");
for (const selected of characters) {
    selected.addEventListener("click", () => {
        document.location.href=`./new.php?id=${selected.dataset.id}`;
    });
}

// Gif au survol //
const cards = document.querySelectorAll('.character_card')
const img = document.querySelectorAll('.character_picture')
const gif = document.querySelectorAll('.character_picture-hover')

for (let i = 0; i < cards.length; i++) {
    cards[i].addEventListener('mouseenter', () => {
        img[i].style.opacity = '0'
        gif[i].style.opacity = '1'

        cards[i].addEventListener('mouseleave', () => {
            img[i].style.opacity = '1'
            gif[i].style.opacity = '0'
        })
    })
}

