import numeral from 'numeral'

const percentageFormatter = function(value) {
  if(!value){
    value = 0
  }

  return numeral(value).format('0.0%')
} 

const moneyFormatter = function(value) {
  if(!value){
    return value = 0
  }

  return numeral(value).format('($0,0.00 a)')
} 

export { percentageFormatter, moneyFormatter }