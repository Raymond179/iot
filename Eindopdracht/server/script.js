// define dimensions of graph
var m = [80, 80, 80, 80]; // margins
var w = 1000 - m[1] - m[3]; // width
var h = 460 - m[0] - m[2]; // height
var xRange = data.map(function(d,i){ return i*100 })
// create a simple data array that we'll plot with a line (this array represents only the Y values, X will just be the index location)

// X scale will fit all values from data[] within pixels 0-w
var x = d3.scale.ordinal().range(xRange).domain(data.map(function(d){ return d.date }));
// Y scale will fit values from 0-10 within pixels h-0 (Note the inverted domain for the y-scale: bigger is up!)
var y = d3.scale.linear().domain([0, d3.max(data, function(d) { return +d.value} )]).range([h, 0]);

// create a line function that can convert data[] into x and y points
var line = d3.svg.line()
	// assign the X function to plot our line as we wish
	.x(function(d,i) { 
		// return the X coordinate where we want to plot this datapoint
		return x(d.date); 
	})
	.y(function(d) { 
		// return the Y coordinate where we want to plot this datapoint
		return y(d.value); 
	})

// Add an SVG element with the desired dimensions and margin.
var graph = d3.select("#graph").append("svg:svg")
      .attr("width", data.length * 100 + m[1] + m[3])
      .attr("height", h + m[0] + m[2])
    .append("svg:g")
      .attr("transform", "translate(" + m[3] + "," + m[0] + ")");
// create yAxis
var xAxis = d3.svg.axis().scale(x).tickSize(-h).tickSubdivide(true).orient("bottom");
// Add the x-axis.
graph.append("svg:g")
      .attr("class", "x axis")
      .attr("transform", "translate(0," + h + ")")
      .call(xAxis);
// create left yAxis
var yAxisLeft = d3.svg.axis().scale(y).ticks(4).orient("left");
// Add the y-axis to the left
graph.append("svg:g")
      .attr("class", "y axis")
      .attr("transform", "translate(-25,0)")
      .call(yAxisLeft);

	// Add the line by appending an svg:path element with the data line we created above
// do this AFTER the axes above so that the line is above the tick-lines
	graph.append("svg:path").attr("d", line(data));

// Source: https://gist.github.com/benjchristensen/2579599