
const cardCountdown = document.querySelectorAll('.card-mini__startText')

const declOfNum = (n, text_forms) => {  
    n = Math.abs(n) % 100; var n1 = n % 10;
    if (n > 10 && n < 20) { return text_forms[2]; }
    if (n1 > 1 && n1 < 5) { return text_forms[1]; }
    if (n1 == 1) { return text_forms[0]; }
    return text_forms[2];
}

cardCountdown.forEach(i => {
  let countdown = i.querySelector('.countdown')
  let finishDate = new Date (countdown.dataset.time).getTime()

  const countdownCards = setInterval(() => {

    let nowDate = new Date().getTime()
    let deadLine = finishDate - nowDate

    let days = Math.floor(deadLine / (1000 * 60 * 60 * 24))
    let hours = Math.floor((deadLine % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60))
    let minutes = Math.floor((deadLine % (1000 * 60 * 60)) / (1000 * 60))
    let seconds = Math.floor((deadLine % (1000 * 60)) / 1000)

    countdown.innerHTML = `${days} ${declOfNum(days, ['день', 'дня', 'дней'])}
                           ${hours} ${declOfNum(hours, ['час', 'часа', 'часов'])}
                           ${minutes} ${declOfNum(minutes, ['минута', 'минуты', 'минут'])}`
  
    if (deadLine < 0) {
      clearInterval(countdownCards);
      countdown.innerHTML = "Курс запущен";
    }

  }, 1000);
})