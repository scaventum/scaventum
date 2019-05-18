import navbar from './components/navbar'
import landing from './components/landing'
import AOS from 'aos'

require('bootstrap')

navbar()
landing()
AOS.init({
    duration: 1000,
    mirror: true,
})