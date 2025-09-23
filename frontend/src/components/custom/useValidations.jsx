import React from 'react'

export default function useValidations(errors, field) {
  const renderErrors = (field) => (
    errors?.[field]?.map((error, index) => (
      <small key={index} className='text-danger'>
        {error}
      </small>
    ))
  )

  return renderErrors(field)
}