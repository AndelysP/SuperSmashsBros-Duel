const characters = document.querySelectorAll(".selected");
for (const selected of characters) {
    selected.addEventListener("click", () => {
        document.location.href=`./new.php?id=${selected.dataset.id}`;
    });
}