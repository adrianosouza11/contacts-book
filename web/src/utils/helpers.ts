export function firstName(fullName: string) : string {
  return fullName && fullName.split(' ').length > 0 ? fullName.split(' ')[0] : '';
}

export function capitalizeFirstLetter(str: string) {
  return str ? str.toLowerCase().charAt(0).toUpperCase() + str.slice(1) : '';
}

export function formattedPhone(phone: string) : string {
  if (!phone) return '';
  
  const digits = phone.replace(/\D/g, '');
  
  // Brazilian phone number format
  if (digits.length === 11) { // Mobile number with DDD
    return `(${digits.slice(0, 2)}) ${digits.slice(2, 7)}-${digits.slice(7)}`;
  } else if (digits.length === 10) { // Landline with DDD
    return `(${digits.slice(0, 2)}) ${digits.slice(2, 6)}-${digits.slice(6)}`;
  } else if (digits.length === 9) { // Mobile number without DDD
    return `${digits.slice(0, 5)}-${digits.slice(5)}`;
  } else if (digits.length === 8) { // Landline without DDD
    return `${digits.slice(0, 4)}-${digits.slice(4)}`;
  }
  
  return digits;
}