const form = document.querySelector('.form')
const input = document.querySelector('.input')
const switcher = document.querySelector('#switcher')
const theme = window.localStorage.getItem('data-theme')

form.addEventListener('submit', (e)=>{
    let value = input.value

    if(value == ''){
        alert('You must write something!')
        
        e.preventDefault()
    }
})

if(theme){
    document.documentElement.setAttribute('data-theme', theme)
}

switcher.checked = theme == 'dark' ? true : false

switcher.addEventListener('change', function(){
    if(this.checked){
        window.localStorage.setItem('data-theme', 'dark')
        document.documentElement.setAttribute('data-theme', 'dark')
    }else{
        window.localStorage.setItem('data-theme', 'light')
        document.documentElement.setAttribute('data-theme', 'light')
    }
})