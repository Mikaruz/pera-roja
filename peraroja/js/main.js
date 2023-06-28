const compose = (...functions) => data =>
  functions.reduceRight((value, func) => func(value), data)

const attrsToString = (obj = {}) =>
  Object.keys(obj)
  .map(attr => `${attr}="${obj[attr]}"`)
  .join('')

const tagAttrs = obj => (content = "") =>
  `<${obj.tag}${obj.attrs ? ' ' : ''}${attrsToString(obj.attrs)}>${content}</${obj.tag}>`

const tag = t =>
  typeof t === 'string' ? tagAttrs({tag: t}) : tagAttrs(t)

const tableRowTag = tag('tr')
const tableRow = items => compose(tableRowTag, tableCells)(items)

const tableCell = tag('td')
const tableCells = items => items.map(tableCell).join('')

const trashIcon = tag({tag: 'i', attrs: {class: 'fas fa-trash-alt'}})('')

let description = document.getElementById('description')
let carbs = document.getElementById('carbs')
let calories = document.getElementById('calories')
let protein = document.getElementById('protein')

let list = []

description.addEventListener('keydown', () =>
    description.classList.remove('is-invalid'))

calories.addEventListener('keydown', () =>
    calories.classList.remove('is-invalid'))

carbs.addEventListener('keydown', () =>
    carbs.classList.remove('is-invalid'))

protein.addEventListener('keydown', () =>
    protein.classList.remove('is-invalid'))


const validateInputs = () => {
    description.value ? '' : description.classList.add('is-invalid')
    calories.value ? '' : calories.classList.add('is-invalid')
    carbs.value ? '' : carbs.classList.add('is-invalid')
    protein.value ? '' : protein.classList.add('is-invalid')

    if(description.value && calories.value && carbs.value && protein.value)
      add()
}

const add = () => {
    const newItem = {
      description: description.value,
      calories: parseInt(calories.value),
      carbs: parseInt(carbs.value),
      protein: parseInt(protein.value)
    }

    list.push(newItem)
    cleanInputs()
    updateTotals()
    renderItems()
}

const updateTotals = () => {
  let calories = 0, carbs = 0, protein = 0

  list.map(item => {
    calories += item.calories,
    carbs += item.carbs,
    protein += item.protein
  })

  document.querySelector('#totalCalories').textContent = calories
  document.querySelector('#totalCarbs').textContent = carbs
  document.querySelector('#totalProtein').textContent = protein
}

const cleanInputs = () => {
    description.value = ''
    calories.value = ''
    carbs.value = ''
    protein.value = ''
}

const renderItems = () => {
  document.querySelector('tbody').innerHTML = ''

  list.map((item, index) => {
    const row = document.createElement('tr')

    const removeButton = tag({
      tag: 'button',
      attrs: {
        class: 'btn btn-outline-danger',
        onclick: `removeItem(${index})`
      }
    })(trashIcon)

    row.innerHTML = tableRow([
      item.description,
      item.calories,
      item.carbs,
      item.protein,
      removeButton])

    document.querySelector('tbody').appendChild(row)

  })

}

const removeItem = index => {
  list.splice(index, 1)

  updateTotals()
  renderItems()
}
