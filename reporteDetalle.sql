SELECT SUM(cantTotalU) AS total, COUNT(codLinea) AS num, AVG(precioMeta) AS meta,(SUM(cantTotalU)*AVG(precioMeta)) AS calculo, mes, vendedor.codVen, vendedor.nomVen
FROM presupuesto_mes, presupuesto_anio, vendedor
WHERE presupuesto_anio.idPresAnio = presupuesto_mes.idPresAnio
AND presupuesto_anio.codVen = vendedor.codVen
AND vendedor.codVen = '82' GROUP BY codVen, mes