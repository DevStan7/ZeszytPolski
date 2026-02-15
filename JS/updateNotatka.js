
const modyfikujNotatkeButton = document.querySelector("#modyfikujNotatke")
const notatkaParagraf = document.querySelector("#notatkaTekst")
modyfikujNotatkeButton.addEventListener("click", e=>{
    e.preventDefault()
    const notatkaTekst = document.querySelector("#notatkaTekst").textContent
    

    let nowyInput = document.createElement("input")
    let nowyButton = document.createElement("button")
    let nowyForm = document.createElement("form")
    nowyButton.name = "sumbitModyfikacja"
    nowyInput.name = "inputModyfikacja"

    nowyButton.innerHTML = 'Modyfikuj'

    nowyForm.method = "POST"

    nowyButton.id = "sumbitModyfikacja"
    nowyInput.id = "inputModyfikacja"

    nowyButton.type = 'submit'
    nowyInput.value = notatkaTekst

    document.querySelector("body").appendChild(nowyForm)
    nowyForm.appendChild(nowyInput)
    nowyForm.appendChild(nowyButton)
    nowyInput.addEventListener("input", () => {
      notatkaParagraf.textContent = nowyInput.value;
    });

    nowyButton.addEventListener("click", e=>{
        let nowaWartosc = document.querySelector("#inputModyfikacja").value
        nowyInput.style.display = 'none'
        nowyButton.style.display = 'none'
        
        notatkaParagraf.innerHTML = nowaWartosc
        notatkaParagraf.style.display = "block"

    })
})


