class Platform {
    constructor(){

    }

    isMobile(agent) {
        agent = agent || ''
        switch(agent.toLowerCase()) {
            case 'android':
                return this.isAndroid()
            case 'ios':
                return this.isIOS()
            case 'windows':
                return this.isWindows()
            case 'blackberry':
                return this.isBlackBerry()
            case 'opera':
                return this.isOpera()
            default:
                return (this.isAndroid() || this.isIOS() || this.isWindows() || this.isBlackBerry()  || this.isOpera())
          }
    }

    isAndroid(){
        return navigator.userAgent.match(/Android/i)
    }

    isIOS(){
        return navigator.userAgent.match(/iPhone|iPad|iPod/i)
    }

    isWindows(){
        return navigator.userAgent.match(/IEMobile/i) || navigator.userAgent.match(/WPDesktop/i)
    }

    isBlackBerry(){
        return navigator.userAgent.match(/BlackBerry/i)
    }

    isOpera(){
        return navigator.userAgent.match(/Opera Mini/i)
    }
}

export default new Platform()