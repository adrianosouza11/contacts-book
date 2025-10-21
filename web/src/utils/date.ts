export function formatToBR(dateString: string) {
  if(!dateString) return '';

  const date = new Date(dateString);

  //if(isNaN(date)) return '';

  return date.toLocaleDateString('pt-BR');
}