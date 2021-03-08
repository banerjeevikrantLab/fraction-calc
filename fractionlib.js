function Fraction(n, d){
	this.n = Number(n);
	this.d = Number(d);
	for(var i = Math.min(n,d); i > 1; i--){
		if(this.n % i == 0 && this.d % i == 0){
			this.n /= i;
			this.d /= i;
		}
	}
	this.toDec = function(){
		return this.n / this.d;
	}
	this.toFrac = function(){
		 return "<table><tr><td class = 'numer frac-part'>" + this.n + "</td></tr><tr><td class= 'denom frac-part'>" + this.d + "</td></tr></table>";
	}
	this.toMix = function(){
		var whole = Math.floor(this.n / this.d);
		var newN = this.n % this.d;
		if(whole == 0){
			return this.toFrac();
		}

		return "<table><tr><td rowspan=2 class = 'frac-part'>"+ whole +"</td><td class = 'frac-part numer'>" + newN + "</td></tr><tr><td class='denom frac-part'>" + this.d + "</td></tr></table>";
	}
	Fraction.add = function (a,b) {
		return new Fraction(a.n * b.d + a.d * b.n , a.d * b.d);
	};
	Fraction.subtract = function (a,b) {
		return new Fraction(a.n * b.d - a.d * b.n , a.d * b.d);
	};
	Fraction.multiply = function (a,b) {
		return new Fraction(a.n * b.n , a.d * b.d);
	};
	Fraction.divide = function (a,b) {
		return new Fraction(a.n * b.d , a.d * b.n);
	};
}