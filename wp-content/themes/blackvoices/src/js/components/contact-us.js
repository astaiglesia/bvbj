/**
* Initializes the site's contactUs component.
* @constructor
* @param {Object} el - The site's contactUs container element.
*/

import { getParent, getSibling} from '../lib/utils'
import {
    isValidStr,
    isValidEmail,
    createSelect
} from '../lib/form-utils'

const contactUs = el => {
    const fnameInput = el.querySelector('#first')
    const lnameInput = el.querySelector('#last')
    const emailInput = el.querySelector('#email')
    const companyInput = el.querySelector('#company')
    const reasonSelect = el.querySelector('select#reason')
    const checkboxes = el.querySelector('#checkboxes')
    const radios = el.querySelector('#radios')
    const inputs = el.querySelectorAll('.input')
    createSelect(reasonSelect)

    fnameInput.addEventListener('blur', () => {
       getParent(fnameInput,'.form__input').classList.remove('error')
       fnameInput.classList.remove('error')
        if(!isValidStr(fnameInput.value)) {
            getParent(fnameInput,'.form__input').classList.add('error')
            fnameInput.classList.add('error')
        }
    })
    
    lnameInput.addEventListener('blur', () => {
        getParent(lnameInput,'.form__input').classList.remove('error')
        lnameInput.classList.remove('error')
        if(!isValidStr(lnameInput.value)) {
            getParent(lnameInput,'.form__input').classList.add('error')
            lnameInput.classList.add('error')
        }
    })

    emailInput.addEventListener('blur', () => {
        getParent(emailInput,'.form__input').classList.remove('error')
        emailInput.classList.remove('error')
        if(!isValidEmail(emailInput.value)) {
            getParent(emailInput,'.form__input').classList.add('error')
            emailInput.classList.add('error')
        }
    })

    companyInput.addEventListener('blur', () => {
        getParent(companyInput,'.form__input').classList.remove('error')
        companyInput.classList.remove('error')
        if(!isValidStr(companyInput.value)) {
            getParent(companyInput,'.form__input').classList.add('error')
            companyInput.classList.add('error')
        }
    })

    checkboxes.querySelectorAll('input').forEach(input => {
        input.addEventListener('click', () => {
            let inputValid = false
            checkboxes.querySelectorAll('input').forEach(inp2 => {
                if(inp2.checked) inputValid = true
            })
            if(inputValid) checkboxes.classList.remove('error')
        })
    })
    
    radios.querySelectorAll('input').forEach(input => {
        input.addEventListener('click', () => {
            let inputValid = false
            radios.querySelectorAll('input').forEach(inp2 => {
                if(inp2.checked) inputValid = true
            })
            if(inputValid) radios.classList.remove('error')
        })
    })

    el.addEventListener('submit', evt => {
        evt.preventDefault()

        let valid = true
        let checkboxValid = false
        let radioValid = false
        let listboxValid = false
        const listbox = document.querySelector('.listbox')

        inputs.forEach(item => item.classList.remove('error'))
    
        if(!isValidStr(fnameInput.value)) {
            fnameInput.classList.add('error')
            getParent(fnameInput,'.form__input').classList.add('error')
            valid = false
        }

        if(!isValidStr(lnameInput.value)) {
            lnameInput.classList.add('error')
            getParent(lnameInput,'.form__input').classList.add('error')
            valid = false
        }

        if(!isValidEmail(emailInput.value)) {
            getParent(emailInput,'.form__input').classList.add('error')
            emailInput.classList.add('error')
            valid = false
        }

        if(!isValidStr(companyInput.value)) {
            getParent(companyInput,'.form__input').classList.add('error')
            companyInput.classList.add('error')
            valid = false
        }

        if(listbox) {
            listbox.querySelectorAll('li').forEach(li => {
                if(!li.classList.contains('disabled')) {
                    li.addEventListener('click', () => getParent(listbox, '.form__input').classList.remove('error'))
                }
                if(li.classList.contains('focused') && !li.classList.contains('disabled')) {
                    listboxValid = true
                }
            })
            if(!listboxValid) {
                getParent(listbox, '.form__input').classList.add('error')
            }
        }

        checkboxes.querySelectorAll('input').forEach(input => {
            if(input.checked) {
                checkboxValid = true
            }
        })
        if(!checkboxValid) {
            checkboxes.classList.add('error')
            valid = false
        }
        
        radios.querySelectorAll('input').forEach(input => {
            if(input.checked) {
                radioValid = true
            }
        })
        if(!radioValid) {
            radios.classList.add('error')
            valid = false
        }
    
        if(valid) {
            console.log('is valid')
            // grecaptcha.ready(function() { // eslint-disable-line
            //     grecaptcha.execute(RECAPTCHA_KEY, {action: 'submit'}).then(function(token) { // eslint-disable-line
                    // const endpoint = `${window.location.protocol}//${window.location.hostname}/testing` // `${window.location.protocol}//${window.location.hostname}/wp-json/braenstone/v1/do-recaptcha?secret=${RECAPTCHA_SECRET}&token=${token}`
                    // Add your logic to submit to your backend server here.
                    // window.fetch(endpoint)
                    // .then(res => {
                    //     res.json().then(data => {
                    //     data = JSON.parse(data)
                    //     data = JSON.parse(data.data.body)
                    //     if(data.success) {
                    //         window.fetch(`${window.location.protocol}//${window.location.hostname}/wp-json/braenstone/v1/get-contact-form-url`)
                    //         .then(res => {
                    //             res.json().then(data => {
                    //             data = JSON.parse(data)
                    //             el.setAttribute('action', data.url)
                    //             el.submit()
                    //             })
                    //         })
                    //     }})
                    // }).catch(e => {
                    //     console.log('Submission failed. Please try again later', e)
                    // })
            //     })
            // })
        }
    })
}
export default function(el) {
    contactUs(el)
}
