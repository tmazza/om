<div id='view'>

</div>
<style>
    .node circle {
        fill: #fff;
        stroke: steelblue;
        stroke-width: 1.5px;
    }
    .node {
        font: 10px sans-serif;
    }
    .link {
        fill: none;
        stroke: #aaa;
        stroke-width: 1.5px;
    }
</style>
<body>
    <script>
        var width = 2000,
                height = 2000;
        var cluster = d3.layout.cluster()
                .size([height, width - 200]);
        var diagonal = d3.svg.diagonal()
                .projection(function(d) {
                    return [d.y, d.x];
                });
        var svg = d3.select("#view").append("svg")
                .attr("width", width)
                .attr("height", height)
                .append("g")
                .attr("transform", "translate(40,0)");
        d3.json("<?= $this->createUrl('arvore/getVer3') ?>", function(error, root) {
            var nodes = cluster.nodes(root),
                    links = cluster.links(nodes);

            var link = svg.selectAll(".link")
                    .data(links)
                    .enter().append("path")
                    .attr("class", "link")
                    .attr("d", diagonal);

            var node = svg.selectAll(".node")
                    .data(nodes)
                    .enter().append("g")
                    .attr("class", "node")
                    .attr("transform", function(d) {
                        return "translate(" + d.y + "," + d.x + ")";
                    })

            node.append("circle")
                    .attr("r", 3);

            node.append("text")
                    .attr("dx", function(d) {
                        return d.children ? -8 : 8;
                    })
                    .attr("dy", 3)
                    .style("text-anchor", function(d) {
                        return d.children ? "end" : "start";
                    })
                    .text(function(d) {
                        return d.name;
                    });
        });

        d3.select(self.frameElement).style("height", height + "px");

    </script>