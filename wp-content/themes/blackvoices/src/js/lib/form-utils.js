import ariaListbox from './aria-listbox.js'
import { getParent, getSibling } from './utils'

// return true if number meets minimum length and value requirements
const isValidNumber = (num, length = false, min = 1) => {
  return length ? num && num.length === length && num >= min : num && num >= min
}

const isValidPhone = str => {
  // strip all non-numeric chars
  const value = str.replace(/\D/g,'')
  return value.length === 10
}

// return true if string has at least 1 number and 1 letter in it
const isValidAddress = str => {
  return /\d/.test(str) && /[a-zA-Z]/g.test(str)
}

// return true if string has at least 1 letter
const isValidStr = str => {
  return str.length >= 1
}

// return true if string is an email address
const isValidEmail = str => {
  const regex = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return regex.test(String(str).toLowerCase())
}

const formatPhone = str => {
  let formattedValue = ''

  // strip all nnon-numeric chars
  const value = str.replace(/\D/g,'')

  for(let i = 0; i < value.length; i++){
    if(i === 0) formattedValue += '('
    if(i === 3) formattedValue += ')'
    if(i === 6) formattedValue += '-'
    formattedValue += value[i]
  }

  return formattedValue
}

const createSelect = (select) => {
  // hide the actual input
  select.classList.add('hidden')

  // set vars
  const textFirst = select.querySelector('option').innerHTML
  const rand = Math.floor(Math.random() * 100001)
  const listBoxWrap = document.createElement('div')
  const button = document.createElement('button')
  const optionList = document.createElement('ul')
  let labelId = getParent(select, 'label') ? getParent(select, 'label').getAttribute('id') : getSibling(select, 'label').getAttribute('id') // $(selectOld).parents('.hs-fieldtype-select').find('label').attr('id')
  if(labelId == null) labelId = ''

  // build the basic structure (wrap, button, list)
  listBoxWrap.classList.add('listbox')
  button.setAttribute('type', 'button')
  button.setAttribute('aria-haspopup', 'listbox')
  if(labelId) button.setAttribute('aria-labelledby', labelId)
  button.setAttribute('id', `button-${rand}`)
  button.innerHTML = textFirst
  optionList.setAttribute('tabindex', '-1')
  optionList.setAttribute('role', 'listbox')
  optionList.setAttribute('id', `list-${rand}`)
  optionList.setAttribute('aria-labelledby', `button-${rand}`)
  optionList.classList.add('hidden')

  // add all the options
  select.querySelectorAll('option').forEach((opt, i) => {
    const value = opt.value ? opt.value : opt.innerHTML
    const li = document.createElement('li')
    li.setAttribute('role', 'option')
    li.setAttribute('id', `option-${rand}-${i}`)
    if(opt.disabled) li.classList.add('disabled','cursor-not-allowed','pointer-events-none')
    li.dataset.value = value
    li.innerHTML = opt.innerHTML
    li.addEventListener('click', evt => {
      getParent(evt.target, '.listbox').classList.remove('listbox--open')

      // if not disabled, set select value
      if(!evt.target.disabled) {
        select.value = value
      }
    })
    optionList.append(li)
  })

  // put it all together
  listBoxWrap.append(button)
  listBoxWrap.append(optionList)
  listBoxWrap.setAttribute('id', `listbox-${rand}`)

  // place listbox after <select>
  select.after(listBoxWrap)

  // set up accessibility, open/close etc
  const listboxList = new ariaListbox.Listbox(document.querySelector(`#list-${rand}`))
  new ariaListbox.ListboxButton(button, listboxList)

  // add click listeners
  button.addEventListener('click', evt => {
    if(getParent(evt.target, '.listbox').classList.contains('listbox--open')){
      getParent(evt.target, '.listbox').classList.remove('listbox--open')
    } else {
      getParent(evt.target, '.listbox').classList.add('listbox--open')
    }
  })
}

export {
  createSelect,
  isValidNumber,
  isValidAddress,
  isValidStr,
  isValidEmail,
  isValidPhone,
  formatPhone
}